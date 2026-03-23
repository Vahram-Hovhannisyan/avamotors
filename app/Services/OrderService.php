<?php

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\CartServiceInterface;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        private readonly CartServiceInterface $cart
    ) {}

    /**
     * Create order from cart with pricing tiers support
     */
    public function createOrder(Request $request, ?User $user, array $cartData = []): Order
    {
        // Если cartData не передана, получаем из корзины
        if (empty($cartData)) {
            $cartData = $this->cart->getCart();
        }

        $items = $cartData['items'] ?? [];
        $total = $cartData['total'] ?? 0;
        $count = $cartData['count'] ?? 0;

        if (empty($items)) {
            throw new \RuntimeException('Корзина пуста.');
        }

        // Рассчитываем subtotal (сумма без скидок)
        $subtotal = 0;
        $discountTotal = 0;

        foreach ($items as $item) {
            $product = $item['product'];
            $originalPrice = $item['original_price'] ?? $product->price;
            $currentPrice = $item['price'];
            $quantity = $item['quantity'];

            $subtotal += $originalPrice * $quantity;
            $discountTotal += ($originalPrice - $currentPrice) * $quantity;
        }

        try {
            return DB::transaction(function () use ($request, $user, $items, $total, $subtotal, $discountTotal) {

                // Создаем заказ с данными о скидках
                $order = Order::create([
                    'user_id' => $user?->id,
                    'name'    => $request->name,
                    'phone'   => $request->phone,
                    'email'   => $request->email,
                    'address' => $request->address,
                    'comment' => $request->comment,
                    'status'  => 'pending',
                    'total'   => $total, // Итоговая сумма со скидками
                    'subtotal' => $subtotal, // Сумма без скидок
                    'discount_total' => $discountTotal, // Общая сумма скидки
                ]);

                \Log::info('Order created with discounts', [
                    'order_id' => $order->id,
                    'subtotal' => $subtotal,
                    'discount_total' => $discountTotal,
                    'total' => $total
                ]);

                // Создаем элементы заказа с ценами со скидками
                foreach ($items as $item) {
                    $product = $item['product'];
                    $originalPrice = $item['original_price'] ?? $product->price;
                    $currentPrice = $item['price'];
                    $quantity = $item['quantity'];
                    $hasDiscount = $item['has_discount'] ?? false;
                    $discountInfo = $item['discount_info'] ?? null;

                    $itemSubtotal = $currentPrice * $quantity;
                    $itemOriginalSubtotal = $originalPrice * $quantity;
                    $itemDiscount = $itemOriginalSubtotal - $itemSubtotal;

                    \Log::info('Creating order item with discount', [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' => $quantity,
                        'original_price' => $originalPrice,
                        'current_price' => $currentPrice,
                        'item_subtotal' => $itemSubtotal,
                        'item_discount' => $itemDiscount,
                        'has_discount' => $hasDiscount
                    ]);

                    $orderItem = $order->items()->create([
                        'product_id'   => $product->id,
                        'product_name' => $product->name,
                        'product_sku'  => $product->sku,
                        'price'        => $currentPrice, // Цена со скидкой
                        'original_price' => $originalPrice, // Оригинальная цена
                        'quantity'     => $quantity,
                        'subtotal'     => $itemSubtotal, // Сумма со скидкой
                        'original_subtotal' => $itemOriginalSubtotal, // Сумма без скидки
                        'discount_amount' => $itemDiscount, // Сумма скидки для этого товара
                        'discount_info' => $discountInfo, // Информация о скидке (JSON)
                    ]);

                    // Уменьшаем количество товара на складе
                    $product->decrement('quantity', $quantity);
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
