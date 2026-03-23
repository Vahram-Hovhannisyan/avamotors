<?php

namespace App\Http\Controllers;

use App\Interfaces\CartServiceInterface;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartServiceInterface $cart
    ) {}

    /**
     * Display cart page
     */
    public function index(): View
    {
        $cartData = $this->cart->getCart();

        // Извлекаем items и total из массива
        $items = $cartData['items'] ?? [];
        $total = $cartData['total'] ?? 0;

        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Product::findOrFail($request->product_id);

            // Check if product is in stock
            if ($product->quantity < (int)$request->quantity) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Недостаточно товара на складе'], 400);
                }
                return back()->with('error', 'Недостаточно товара на складе');
            }

            // Используем сервис для добавления товара
            $this->cart->add($request->product_id, $request->quantity);

            // Получаем обновленное количество товаров в корзине
            $cartCount = $this->cart->count();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Товар добавлен в корзину',
                    'cart_count' => $cartCount
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину');

        } catch (\RuntimeException $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 400);
            }
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Произошла ошибка при добавлении товара'], 500);
            }
            return back()->with('error', 'Произошла ошибка при добавлении товара');
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'product_id' => ['required', 'exists:products,id'],
                'quantity'   => ['required', 'integer', 'min:0', 'max:99'],
            ]);

            $this->cart->update(
                $request->integer('product_id'),
                $request->integer('quantity')
            );

            $message = $request->quantity > 0
                ? 'Корзина обновлена.'
                : 'Товар удалён из корзины.';

            return back()->with('success', $message);

        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove product from cart
     */
    public function remove(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'product_id' => ['required', 'exists:products,id']
            ]);

            $this->cart->remove($request->integer('product_id'));

            return back()->with('success', 'Товар удалён из корзины.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при удалении товара');
        }
    }

    /**
     * Clear cart
     */
    public function clear(): RedirectResponse
    {
        try {
            $this->cart->clear();
            return redirect()->route('cart.index')->with('success', 'Корзина очищена.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при очистке корзины');
        }
    }

    /**
     * Get cart count for AJAX requests
     */
    public function count(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                'count' => $this->cart->count(),
                'total' => $this->cart->total()
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
