<?php

namespace App\Http\Controllers;

use App\Interfaces\CartServiceInterface;
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
        return view('cart.index', $this->cart->getCart());
    }

    /**
     * Add product to cart
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        try {
            $this->cart->add(
                $request->integer('product_id'),
                $request->integer('quantity', 1)
            );

            return back()->with('success', 'Товар добавлен в корзину.');

        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity'   => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        try {
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
        $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        $this->cart->remove($request->integer('product_id'));

        return back()->with('success', 'Товар удалён из корзины.');
    }

    /**
     * Clear cart
     */
    public function clear(): RedirectResponse
    {
        $this->cart->clear();
        return redirect()->route('cart.index')
            ->with('success', 'Корзина очищена.');
    }

    /**
     * Get cart count for AJAX requests
     */
    public function count(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'count' => $this->cart->count(),
            'total' => $this->cart->total()
        ]);
    }
}
