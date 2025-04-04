<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Mojahid\Ecommerce\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends BackendController
{
 /**
     * Get revenue chart data
     * 
     * @return JsonResponse
     */
    public function revenueChart(): JsonResponse
    {
        $result = Cache::store('file')->remember(
            cache_prefix('ecommerce_revenue_chart'),
            3600,
            function () {
                $dates = [];
                $revenue = [];
                $orders = [];
                
                $today = Carbon::today();
                $startDay = $today->copy()->subDays(29);
                
                for ($i = 0; $i < 30; $i++) {
                    $currentDate = $startDay->copy()->addDays($i);
                    $formattedDate = $currentDate->format('Y-m-d');
                    
                    $dates[] = $currentDate->format('M d');
                    $revenue[] = $this->getRevenueByday($formattedDate);
                    $orders[] = $this->getOrdersByDay($formattedDate);
                }
                
                return [
                    'dates' => $dates,
                    'revenue' => $revenue,
                    'orders' => $orders,
                ];
            }
        );
        
        return response()->json($result);
    }
    
    /**
     * Get revenue for a specific day
     * 
     * @param string $date Date in Y-m-d format
     * @return float
     */
    protected function getRevenueByday(string $date): float
    {
        return Order::whereDate('created_at', $date)
            ->where('status', 'completed')
            ->sum('total');
    }
    
    /**
     * Get order count for a specific day
     * 
     * @param string $date Date in Y-m-d format
     * @return int
     */
    protected function getOrdersByDay(string $date): int
    {
        return Order::whereDate('created_at', $date)->count();
    }

    /**
     * Get all chart data for dashboard
     * 
     * @return JsonResponse
     */
    public function chartsData(): JsonResponse
    {
        $result = Cache::store('file')->remember(
            cache_prefix('ecommerce_dashboard_charts'),
            3600,
            function () {
                return [
                    'monthlySales' => $this->getMonthlySalesData(),
                    'monthlyRefunds' => $this->getMonthlyRefundsData(),
                    'revenueTrend' => $this->getRevenueTrendData(),
                    'ordersTrend' => $this->getOrdersTrendData(),
                    'orderStatus' => $this->getOrderStatusData(),
                ];
            }
        );
        
        return response()->json($result);
    }
    
    /**
     * Get monthly sales data
     * 
     * @return array
     */
    protected function getMonthlySalesData(): array
    {
        $data = $this->getMonthlyData('total', 'completed');
        
        return [
            'labels' => $data->pluck('month')->toArray(),
            'values' => $data->pluck('value')->toArray(),
        ];
    }
    
    /**
     * Get monthly refunds data
     * 
     * @return array
     */
    protected function getMonthlyRefundsData(): array
    {
        $data = $this->getMonthlyData('total', 'refunded');
        
        return [
            'labels' => $data->pluck('month')->toArray(),
            'values' => $data->pluck('value')->toArray(),
        ];
    }
    
    /**
     * Get revenue trend data (past 30 days)
     * 
     * @return array
     */
    protected function getRevenueTrendData(): array
    {
        $data = $this->getDailyData('total', 'completed', 30);
        
        return [
            'labels' => $data->pluck('date')->toArray(),
            'values' => $data->pluck('value')->toArray(),
        ];
    }
    
    /**
     * Get orders trend data (past 30 days)
     * 
     * @return array
     */
    protected function getOrdersTrendData(): array
    {
        $data = $this->getDailyOrdersData(30);
        
        return [
            'labels' => $data->pluck('date')->toArray(),
            'values' => $data->pluck('count')->toArray(),
        ];
    }
    
    /**
     * Get order status distribution
     * 
     * @return array
     */
    protected function getOrderStatusData(): array
    {
        $statuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => $item->count];
            });
        
        // Common order statuses: pending, processing, completed, cancelled, refunded
        $statusLabels = [
            'completed' => trans('ecomm::content.status_completed'),
            'processing' => trans('ecomm::content.status_processing'),
            'pending' => trans('ecomm::content.status_pending'),
            'cancelled' => trans('ecomm::content.status_cancelled'),
            'refunded' => trans('ecomm::content.status_refunded'),
        ];
        
        $values = [];
        $labels = [];
        
        foreach ($statusLabels as $status => $label) {
            if (isset($statuses[$status])) {
                $values[] = $statuses[$status];
                $labels[] = $label;
            }
        }
        
        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }
    
    /**
     * Get monthly data for a specific column and status
     * 
     * @param string $column Column to aggregate
     * @param string|null $status Status filter
     * @param int $months Number of months to include
     * @return \Illuminate\Support\Collection
     */
    protected function getMonthlyData(string $column, ?string $status = null, int $months = 6)
    {
        $query = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month_key"),
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
            DB::raw("SUM({$column}) as value")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths($months))
            ->groupBy('month_key', 'month')
            ->orderBy('month_key');
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->get();
    }
    
    /**
     * Get daily data for a specific column and status
     * 
     * @param string $column Column to aggregate
     * @param string|null $status Status filter
     * @param int $days Number of days to include
     * @return \Illuminate\Support\Collection
     */
    protected function getDailyData(string $column, ?string $status = null, int $days = 30)
    {
        $query = Order::select(
            DB::raw("DATE(created_at) as date_key"),
            DB::raw("DATE_FORMAT(created_at, '%d %b') as date"),
            DB::raw("SUM({$column}) as value")
        )
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date_key', 'date')
            ->orderBy('date_key');
        
        if ($status) {
            $query->where('status', $status);
        }
        
        return $query->get();
    }
    
    /**
     * Get daily orders count
     * 
     * @param int $days Number of days to include
     * @return \Illuminate\Support\Collection
     */
    protected function getDailyOrdersData(int $days = 30)
    {
        return Order::select(
            DB::raw("DATE(created_at) as date_key"),
            DB::raw("DATE_FORMAT(created_at, '%d %b') as date"),
            DB::raw("COUNT(*) as count")
        )
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date_key', 'date')
            ->orderBy('date_key')
            ->get();
    }
}
