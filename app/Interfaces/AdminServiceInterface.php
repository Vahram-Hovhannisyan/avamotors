<?php

namespace App\Interfaces;

interface AdminServiceInterface
{
    /**
     * Get dashboard statistics array.
     */
    public function getDashboardStats(): array;

    /**
     * Get low stock products (quantity between 1 and threshold).
     */
    public function getLowStockProducts(int $threshold = 5): \Illuminate\Database\Eloquent\Collection;

    /**
     * Get out of stock products (quantity = 0).
     */
    public function getOutOfStockProducts(): \Illuminate\Database\Eloquent\Collection;
}
