<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\CartServiceInterface;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderServiceInterface $orders,
        private readonly CartServiceInterface $cart
    ) {}

    /**
     * Show checkout page
     */
    public function checkout(): View|RedirectResponse
    {
        // Получаем данные корзины с учетом ценовых уровней
        $cartData = $this->cart->getCart();

        // Проверяем, что корзина не пуста
        if (empty($cartData['items'])) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста.');
        }

        // Подготавливаем данные для шаблона
        $data = [
            'items' => $cartData['items'],      // Массив товаров с ценами со скидками
            'total' => $cartData['total'],      // Общая сумма со скидками
            'count' => $cartData['count'],      // Количество товаров
            'user' => auth()->user(),           // Текущий пользователь
        ];

        // Для отладки
        \Log::info('Checkout data', [
            'items_count' => count($cartData['items']),
            'total' => $cartData['total'],
            'has_discounts' => collect($cartData['items'])->contains('has_discount', true)
        ]);

        return view('orders.checkout', $data);
    }

    /**
     * Store order
     */
    public function store(CheckoutRequest $request): RedirectResponse
    {
        \Log::info('Store method called', [
            'request' => $request->all(),
            'user' => auth()->user()?->id
        ]);

        try {
            // Получаем данные корзины с ценами со скидками
            $cartData = $this->cart->getCart();

            if (empty($cartData['items'])) {
                return redirect()->route('cart.index')
                    ->with('error', 'Корзина пуста.');
            }

            // Создаем заказ с данными корзины
            $order = $this->orders->createOrder(
                $request,
                auth()->user(),
                $cartData // Передаем данные корзины с ценами
            );

            \Log::info('Order created successfully', [
                'order_id' => $order->id,
                'total' => $order->total,
                'discount_total' => $order->discount_total ?? 0
            ]);

            return redirect()->route('orders.success')
                ->with('order_id', $order->id);

        } catch (\Exception $e) {
            \Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Order success page
     */
    public function success(): View
    {
        $orderId = session('order_id');
        $order = null;

        if ($orderId) {
            $order = Order::with('items.product')->find($orderId);
        }

        return view('orders.success', [
            'orderId' => $orderId,
            'order' => $order
        ]);
    }

    /**
     * User orders list
     */
    public function index(): View
    {
        $orders = $this->orders->getUserOrders(auth()->user());
        return view('orders.index', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }
}
