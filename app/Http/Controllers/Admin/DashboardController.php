<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\AdminServiceInterface;
use App\Models\Analog;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(
        private readonly AdminServiceInterface $adminService,
    ) {}

    public function index(Request $request)
    {
        $stats        = $this->adminService->getDashboardStats();
        $lowStock     = $this->adminService->getLowStockProducts();
        $outStock     = $this->adminService->getOutOfStockProducts();
        $recent       = Product::with('category')->latest()->take(8)->get();
        $recentOrders = Order::with('user')->withCount('items')->latest()->take(8)->get();
        $recentUsers  = User::latest()->take(8)->get();
        $totalAnalogs = Analog::count();
        $analogBrands = Analog::distinct()->orderBy('brand')->pluck('brand');

        $analogQuery = Analog::withCount('products');
        if ($request->filled('aq')) {
            $q = $request->aq;
            $analogQuery->where(fn($sq) =>
                $sq->where('brand', 'like', "%$q%")
                   ->orWhere('sku',   'like', "%$q%")
            );
        }
        $analogList = $analogQuery->orderBy('brand')->orderBy('sku')->paginate(10);

        // ── Аналитика ────────────────────────────────────

        // Период: последние 30 дней
        $period = $request->input('period', 30);
        $from   = now()->subDays((int) $period)->startOfDay();

        // Выручка по дням
        $revenueByDay = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', $from)
            ->selectRaw("DATE(created_at) as date, SUM(total) as revenue, COUNT(*) as count")
            ->groupByRaw("DATE(created_at)")
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Заполняем пропущенные дни нулями
        $revenueDays = [];
        for ($i = (int) $period - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $revenueDays[] = [
                'date'    => now()->subDays($i)->format('d.m'),
                'revenue' => $revenueByDay[$date]->revenue ?? 0,
                'count'   => $revenueByDay[$date]->count   ?? 0,
            ];
        }

        // Итого за период
        $totalRevenue = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', $from)
            ->sum('total');

        $totalOrders = Order::where('status', '!=', 'cancelled')
            ->where('created_at', '>=', $from)
            ->count();

        $avgOrder = $totalOrders > 0 ? round($totalRevenue / $totalOrders) : 0;

        // Топ-10 товаров по количеству продаж
        $topProducts = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 'cancelled')
            ->where('orders.created_at', '>=', $from)
            ->selectRaw('
                order_items.product_name,
                order_items.product_sku,
                SUM(order_items.quantity) as total_qty,
                SUM(order_items.subtotal) as total_revenue,
                COUNT(DISTINCT order_items.order_id) as order_count
            ')
            ->groupBy('order_items.product_name', 'order_items.product_sku')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        // Выручка по статусам
        $revenueByStatus = Order::where('created_at', '>=', $from)
            ->selectRaw("status, COUNT(*) as count, SUM(total) as revenue")
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        return view('admin.dashboard', compact(
            'stats', 'recent', 'recentOrders', 'recentUsers',
            'lowStock', 'outStock',
            'totalAnalogs', 'analogBrands', 'analogList',
            // Аналитика
            'revenueDays', 'totalRevenue', 'totalOrders', 'avgOrder',
            'topProducts', 'revenueByStatus', 'period'
        ));
    }
}