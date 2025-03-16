<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        // Get the current month
        $currentMonth = now()->month;

        // Fetch data for users, order, and user orders
        $freelancersCount        = User::where('role', 'freelancer')->count();
        $customersCount          = User::where('role', 'customer')->whereMonth('created_at', $currentMonth)->count();
        
        // Service orders data
        $serviceOrdersTotalValue = Order::whereMonth('created_at', $currentMonth)->sum('total');
        $serviceOrdersCount      = Order::whereMonth('created_at', $currentMonth)->count();
        
        // Product orders data
        $productOrdersCount      = \App\Models\ProductOrder::whereMonth('created_at', $currentMonth)->count();
        $productOrdersTotalValue = \App\Models\ProductOrder::whereMonth('created_at', $currentMonth)->sum('total');
        
        // Combined orders data
        $ordersTotalValue        = $serviceOrdersTotalValue + $productOrdersTotalValue;
        $ordersCount             = $serviceOrdersCount + $productOrdersCount;

        // Percentage increase or decrease
        $lastMonthCustomersCount    = User::where('role', 'customer')->whereMonth('created_at', now()->subMonth()->month)->count();
        $customersPercentage        = $this->calculatePercentage($lastMonthCustomersCount, $customersCount);
        
        // Service orders percentage
        $lastMonthServiceOrdersTotalValue = Order::whereMonth('created_at', now()->subMonth()->month)->sum('total');
        $serviceOrdersValuePercentage     = $this->calculatePercentage($lastMonthServiceOrdersTotalValue, $serviceOrdersTotalValue);
        $lastMonthServiceOrdersCount      = Order::whereMonth('created_at', now()->subMonth()->month)->count();
        $serviceOrdersPercentage          = $this->calculatePercentage($lastMonthServiceOrdersCount, $serviceOrdersCount);

        // Product orders percentage calculation
        $lastMonthProductOrdersCount = \App\Models\ProductOrder::whereMonth('created_at', now()->subMonth()->month)->count();
        $productOrdersPercentage     = $this->calculatePercentage($lastMonthProductOrdersCount, $productOrdersCount);
        $lastMonthProductOrdersTotalValue = \App\Models\ProductOrder::whereMonth('created_at', now()->subMonth()->month)->sum('total');
        $productOrdersValuePercentage     = $this->calculatePercentage($lastMonthProductOrdersTotalValue, $productOrdersTotalValue);
        
        // Combined orders percentage
        $lastMonthOrdersTotalValue  = $lastMonthServiceOrdersTotalValue + $lastMonthProductOrdersTotalValue;
        $ordersValuePercentage      = $this->calculatePercentage($lastMonthOrdersTotalValue, $ordersTotalValue);
        $lastMonthOrdersCount       = $lastMonthServiceOrdersCount + $lastMonthProductOrdersCount;
        $ordersPercentage           = $this->calculatePercentage($lastMonthOrdersCount, $ordersCount);

        // Set date range (e.g., last 30 days)
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        // Generate a complete date range
        $dateRange = collect(CarbonPeriod::create($startDate, $endDate))->map(function ($date) {
            return $date->format('Y-m-d');
        });

        // Fetch and format data for the reports chart
        $customersData = User::where('role', 'customer')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $serviceOrdersValueData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, sum(total) as sum')
            ->groupBy('date')
            ->pluck('sum', 'date')
            ->toArray();

        $serviceOrdersCountData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Add product orders chart data
        $productOrdersCountData = \App\Models\ProductOrder::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();
            
        $productOrdersValueData = \App\Models\ProductOrder::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, sum(total) as sum')
            ->groupBy('date')
            ->pluck('sum', 'date')
            ->toArray();

        // Merge data with the complete date range
        $reportsData = $dateRange->mapWithKeys(function ($date) use (
            $customersData, 
            $serviceOrdersValueData, 
            $serviceOrdersCountData, 
            $productOrdersCountData, 
            $productOrdersValueData
        ) {
            // Calculate combined orders data for each date
            $ordersCount = ($serviceOrdersCountData[$date] ?? 0) + ($productOrdersCountData[$date] ?? 0);
            $ordersValue = ($serviceOrdersValueData[$date] ?? 0) + ($productOrdersValueData[$date] ?? 0);
            
            return [
                $date => [
                    'customers' => $customersData[$date] ?? 0,
                    'serviceOrdersValue' => $serviceOrdersValueData[$date] ?? 0,
                    'serviceOrders' => $serviceOrdersCountData[$date] ?? 0,
                    'productOrders' => $productOrdersCountData[$date] ?? 0,
                    'productOrdersValue' => $productOrdersValueData[$date] ?? 0,
                    'ordersValue' => $ordersValue,
                    'orders' => $ordersCount,
                ]
            ];
        });

        // Latest Orders
        $latestOrders = Order::latest()->take(5)->get();
        // Latest withdrawals
        $latestPayments = Payment::latest()->take(5)->get();
        // Latest product orders
        $latestProductOrders = \App\Models\ProductOrder::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'freelancersCount',
            'customersCount',
            'customersPercentage',
            'ordersTotalValue',
            'ordersValuePercentage',
            'ordersCount',
            'ordersPercentage',
            'serviceOrdersTotalValue',
            'serviceOrdersValuePercentage',
            'serviceOrdersCount',
            'serviceOrdersPercentage',
            'productOrdersCount',
            'productOrdersTotalValue',
            'productOrdersPercentage',
            'productOrdersValuePercentage',
            'reportsData',
            'latestOrders',
            'latestPayments',
            'latestProductOrders'
        ));
    }

    public function freelancer(Request $request)
    {
        $freelancer = $request->user();
        $currentMonth = now()->month;

        // Orders Count
        $ordersCount = $freelancer->freelancerOrders()->whereMonth('created_at', $currentMonth)->count();
        $lastMonthOrdersCount = $freelancer->freelancerOrders()->whereMonth('created_at', now()->subMonth()->month)->count();
        $orderPercentage = $this->calculatePercentage($lastMonthOrdersCount, $ordersCount);

        // Total Earnings
        $totalEarnings = $freelancer->offers()->where('status', 'accepted')->whereMonth('created_at', $currentMonth)->sum('admin_price');
        $lastMonthEarnings = $freelancer->offers()->where('status', 'accepted')->whereMonth('created_at', now()->subMonth()->month)->sum('admin_price');
        $earningsPercentage = $this->calculatePercentage($lastMonthEarnings, $totalEarnings);

        // Offers Count
        $offersCount = $freelancer->freelancerOrders()->whereMonth('created_at', $currentMonth)->count();
        $lastMonthOffersCount = $freelancer->freelancerOrders()->whereMonth('created_at', now()->subMonth()->month)->count();
        $offersPercentage = $this->calculatePercentage($lastMonthOffersCount, $offersCount);

        // Set date range (e.g., last 30 days)
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        // Generate a complete date range
        $dateRange = collect(CarbonPeriod::create($startDate, $endDate))->map(function ($date) {
            return $date->format('Y-m-d');
        });

        // Fetch and format data for the reports chart
        $ordersData = $freelancer->freelancerOrders()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $offersData = $freelancer->offers()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Merge data with the complete date range
        $reportsData = $dateRange->mapWithKeys(function ($date) use ($ordersData, $offersData) {
            return [
                $date => [
                    'orders' => $ordersData[$date] ?? 0,
                    'offers' => $offersData[$date] ?? 0,
                ]
            ];
        });

        // Latest Orders
        $latestOrders = $freelancer->freelancerOrders()->latest()->take(5)->get();

        // Upcoming Deadlines
        $upcomingDeadlines = $freelancer->freelancerOrders()
            ->where('status', '!=', 'completed')
            ->where('deadline', '>', now())
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('freelancer.dashboard', compact(
            'ordersCount',
            'orderPercentage',
            'totalEarnings',
            'earningsPercentage',
            'offersCount',
            'offersPercentage',
            'reportsData',
            'latestOrders',
            'upcomingDeadlines'
        ));
    }

    private function calculatePercentage($oldValue, $newValue)
    {
        if ($oldValue == 0) {
            return $newValue > 0 ? 100 : 0;
        }

        return (($newValue - $oldValue) / $oldValue) * 100;
    }
}
