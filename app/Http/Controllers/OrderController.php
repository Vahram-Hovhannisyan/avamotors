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
        private readonly CartServiceInterface $cart  // Добавить CartService
    ) {}

    // Методы корзины теперь в CartController, удалите их отсюда

    public function checkout(): View|RedirectResponse
    {
        // Получаем данные корзины
        $cartData = $this->cart->getCart();

        // Проверяем, что корзина не пуста
        if (empty($cartData['items'])) {
            return redirect()->route('cart.index')
                ->with('error', 'Корзина пуста.');
        }

        // Подготавливаем данные для шаблона
        $data = [
            'items' => $cartData['items'],      // Массив товаров
            'total' => $cartData['total'],      // Общая сумма
            'count' => $cartData['count'],      // Количество товаров
            'user' => auth()->user(),           // Текущий пользователь
        ];

        // Для отладки (можно удалить после проверки)
         \Log::info('Checkout data', $data);

        return view('orders.checkout', $data);
    }

    public function store(CheckoutRequest $request): RedirectResponse
    {
        \Log::info('Store method called', [
            'request' => $request->all(),
            'user' => auth()->user()?->id
        ]);

        try {
            $order = $this->orders->createOrder(
                $request,
                auth()->user()
            );

            \Log::info('Order created', ['order_id' => $order->id]);

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

    public function success(): View
    {
        // Получаем ID заказа из сессии
        $orderId = session('order_id');

        // Если нужно получить полные данные заказа
        $order = null;
        if ($orderId) {
            $order = Order::with('items')->find($orderId);
        }

        return view('orders.success', [
            'orderId' => $orderId,
            'order' => $order  // Передаем объект заказа (может быть null)
        ]);
    }

    public function index(): View
    {
        $orders = $this->orders->getUserOrders(auth()->user());
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);
        $order->load('items');
        return view('orders.show', compact('order'));
    }
}
