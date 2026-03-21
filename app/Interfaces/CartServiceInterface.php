<?php

namespace App\Interfaces;

interface CartServiceInterface
{
    /**
     * Get cart contents
     */
    public function getCart(): array;

    /**
     * Get cart items with product models
     */
    public function getItems(): array;

    /**
     * Add product to cart
     */
    public function add(int $productId, int $quantity = 1): void;

    /**
     * Update cart item quantity
     */
    public function update(int $productId, int $quantity): void;

    /**
     * Remove product from cart
     */
    public function remove(int $productId): void;

    /**
     * Clear cart
     */
    public function clear(): void;

    /**
     * Get cart count
     */
    public function count(): int;

    /**
     * Get cart total
     */
    public function total(): float;
}
