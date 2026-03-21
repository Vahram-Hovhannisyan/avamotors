<?php

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\CartServiceInterface;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface  // Теперь только 3 метода
{
    public function __construct(
        private readonly CartServiceInterface $cart
    ) {}

    public function createOrder(Request $request, ?User $user): Order
    {
        $items = $this->cart->getItems();

        if (empty($items)) {
            throw new \RuntimeException('Корзина пуста.');
        }

        try {
            return DB::transaction(function () use ($request, $user, $items) {

                // Создаем заказ
                $order = Order::create([
                    'user_id' => $user?->id,
                    'name'    => $request->name,
                    'phone'   => $request->phone,
                    'email'   => $request->email,
                    'address' => $request->address,
                    'comment' => $request->comment,
                    'status'  => 'pending',
                    'total'   => $this->cart->total(),
                ]);

                // Создаем элементы заказа
                foreach ($items as $item) {
                    $product = $item['product'];

                    // Рассчитываем subtotal
                    $subtotal = $product->price * $item['quantity'];

                    \Log::info('Creating order item', [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $product->price,
                        'subtotal' => $subtotal
                    ]);

                    $order->items()->create([
                        'product_id'   => $product->id,
                        'product_name' => $product->name,
                        'product_sku'  => $product->sku,
                        'price'        => $product->price,
                        'quantity'     => $item['quantity'],
                        'subtotal'     => $subtotal, // ОБЯЗАТЕЛЬНО нужно передавать!
                    ]);

                    // Уменьшаем количество товара
                    $product->decrement('quantity', $item['quantity']);
                }

                // Очищаем корзину
                $this->cart->clear();

                return $order;
            });

        } catch (\Exception $e) {
            \Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw new \RuntimeException('Ошибка при создании заказа: ' . $e->getMessage());
        }
    }

    public function getUserOrders(User $user, int $perPage = 10)
    {
        return $user->orders()
            ->with('items')
            ->latest()
            ->paginate($perPage);
    }

    public function updateStatus(Order $order, string $status): Order
    {
        $allowedStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        if (!in_array($status, $allowedStatuses)) {
            throw new \InvalidArgumentException("Invalid status: {$status}");
        }

        $order->update(['status' => $status]);

        return $order;
    }
}
