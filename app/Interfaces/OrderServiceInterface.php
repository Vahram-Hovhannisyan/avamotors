<?php

namespace App\Interfaces;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

interface OrderServiceInterface
{
    /**
     * Create order from cart with pricing tiers support
     */
    public function createOrder(Request $request, ?User $user, array $cartData = []): Order;

    /**
     * Get paginated orders for a user
     */
    public function getUserOrders(User $user, int $perPage = 10);

    /**
     * Update order status
     */
    public function updateStatus(Order $order, string $status): Order;
}
