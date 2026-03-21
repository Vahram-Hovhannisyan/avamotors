<?php

namespace App\Services;

use App\Interfaces\AdminServiceInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AdminService implements AdminServiceInterface
{
    public function getDashboardStats(): array
    {
        return [
            'products'   => Product::count(),
            'active'     => Product::where('is_active', true)->count(),
            'users'      => User::where('role', 'customer')->count(),
            'categories' => \App\Models\Category::count(),
            'low_stock'  => Product::where('quantity', '>', 0)->where('quantity', '<', 5)->count(),
            'out_stock'  => Product::where('quantity', 0)->count(),
            'orders'     => Order::count(),
            'new_orders' => Order::where('status', 'pending')->count(),
        ];
    }

    public function getLowStockProducts(int $threshold = 5): Collection
    {
        return Product::with('category')
            ->where('quantity', '>', 0)
            ->where('quantity', '<', $threshold)
            ->orderBy('quantity')
            ->get();
    }

    public function getOutOfStockProducts(): Collection
    {
        return Product::with('category')
            ->where('quantity', 0)
            ->latest()
            ->get();
    }
}
