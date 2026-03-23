<?php

namespace App\Services;

use App\Interfaces\CartServiceInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService implements CartServiceInterface
{
    private ?Cart $cart = null;
    private array $items = [];
    private $user = null;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->loadCart();
    }

    private function loadCart(): void
    {
        if (auth()->check()) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => auth()->id()],
                ['items' => []]
            );
        } else {
            $sessionId = session()->getId();
            $this->cart = Cart::firstOrCreate(
                ['session_id' => $sessionId],
                ['items' => []]
            );
        }

        $this->loadItems();
    }

    private function loadItems(): void
    {
        $items = $this->cart->items ?? [];
        $productIds = array_column($items, 'product_id');

        if (empty($productIds)) {
            $this->items = [];
            return;
        }

        $products = Product::whereIn('id', $productIds)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $this->items = [];
        foreach ($items as $item) {
            $product = $products[$item['product_id']] ?? null;
            if ($product) {
                // Получаем цену с учетом ценовых уровней
                $finalPrice = $product->getPriceForUser($this->user);
                $hasDiscount = $product->hasSpecialPriceForUser($this->user);
                $discountInfo = $product->getDiscountForUser($this->user);

                $this->items[] = [
                    'product_id' => $item['product_id'],
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $finalPrice, // Используем цену с учетом скидки
                    'original_price' => $product->price, // Оригинальная цена
                    'has_discount' => $hasDiscount,
                    'discount_info' => $discountInfo,
                    'name' => $item['name'] ?? $product->name,
                    'sku' => $item['sku'] ?? $product->sku,
                ];
            }
        }

        $this->save();
    }

    private function save(): void
    {
        $items = array_map(function ($item) {
            return [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'], // Сохраняем цену со скидкой
                'original_price' => $item['original_price'] ?? $item['price'],
                'name' => $item['name'],
                'sku' => $item['sku'],
            ];
        }, $this->items);

        $this->cart->items = $items;
        $this->cart->save();

        Log::info('Cart saved', [
            'cart_id' => $this->cart->id,
            'user_id' => $this->cart->user_id,
            'session_id' => $this->cart->session_id,
            'items_count' => count($items)
        ]);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCart(): array
    {
        $result = [
            'items' => $this->items,
            'count' => $this->count(),
            'total' => $this->total()
        ];

        Log::info('CartService getCart()', [
            'items_count' => count($this->items),
            'total' => $result['total'],
            'items' => array_map(function($item) {
                return [
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'original_price' => $item['original_price'] ?? null,
                    'has_discount' => $item['has_discount'] ?? false
                ];
            }, $this->items)
        ]);

        return $result;
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        if (!$product->is_active) {
            throw new \RuntimeException('Товар не доступен для заказа.');
        }

        // Получаем цену с учетом ценовых уровней
        $finalPrice = $product->getPriceForUser($this->user);
        $hasDiscount = $product->hasSpecialPriceForUser($this->user);
        $discountInfo = $product->getDiscountForUser($this->user);

        foreach ($this->items as &$item) {
            if ($item['product_id'] == $productId) {
                $newQuantity = $item['quantity'] + $quantity;

                if ($product->quantity < $newQuantity) {
                    throw new \RuntimeException('Недостаточно товара на складе.');
                }

                $item['quantity'] = $newQuantity;
                $item['price'] = $finalPrice;
                $item['original_price'] = $product->price;
                $item['has_discount'] = $hasDiscount;
                $item['discount_info'] = $discountInfo;
                $item['name'] = $product->name;
                $item['sku'] = $product->sku;
                $this->save();
                return;
            }
        }

        if ($product->quantity < $quantity) {
            throw new \RuntimeException('Недостаточно товара на складе.');
        }

        $this->items[] = [
            'product_id' => $productId,
            'product' => $product,
            'quantity' => $quantity,
            'price' => $finalPrice,
            'original_price' => $product->price,
            'has_discount' => $hasDiscount,
            'discount_info' => $discountInfo,
            'name' => $product->name,
            'sku' => $product->sku,
        ];

        $this->save();

        Log::info('Product added to cart', [
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $finalPrice,
            'has_discount' => $hasDiscount,
            'total_items' => count($this->items)
        ]);
    }

    public function update(int $productId, int $quantity): void
    {
        if ($quantity <= 0) {
            $this->remove($productId);
            return;
        }

        $product = Product::findOrFail($productId);
        $finalPrice = $product->getPriceForUser($this->user);
        $hasDiscount = $product->hasSpecialPriceForUser($this->user);
        $discountInfo = $product->getDiscountForUser($this->user);

        foreach ($this->items as &$item) {
            if ($item['product_id'] == $productId) {
                if ($product->quantity < $quantity) {
                    throw new \RuntimeException('Недостаточно товара на складе.');
                }

                $item['quantity'] = $quantity;
                $item['price'] = $finalPrice;
                $item['original_price'] = $product->price;
                $item['has_discount'] = $hasDiscount;
                $item['discount_info'] = $discountInfo;
                $item['name'] = $product->name;
                $item['sku'] = $product->sku;
                $this->save();
                return;
            }
        }

        throw new \RuntimeException('Товар не найден в корзине.');
    }

    public function remove(int $productId): void
    {
        $this->items = array_filter($this->items, function ($item) use ($productId) {
            return $item['product_id'] != $productId;
        });

        $this->save();
    }

    public function clear(): void
    {
        $this->items = [];
        $this->save();
    }

    public function count(): int
    {
        return array_sum(array_column($this->items, 'quantity'));
    }

    public function total(): float
    {
        return array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
}
