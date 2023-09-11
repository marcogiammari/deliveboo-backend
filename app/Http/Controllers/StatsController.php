<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class StatsController extends Controller
{
    public function index()
    {

        $user_id = Auth::user()->id;

        // incomes 
        $day_income = Order::where('is_paid', true)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

        $month_income = Order::where('is_paid', true)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

        $year_income = Order::where('is_paid', true)->whereYear('created_at', Carbon::now()->year)->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

        $total_income = Order::where('is_paid', true)->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

        // best & worst
        $best_selling_product = Product::select('products.name')
        ->join('order_product', 'products.id', '=', 'order_product.product_id')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('is_paid', true)
        ->whereHas('restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })
        ->whereMonth('orders.created_at', Carbon::now()->month)
        ->groupBy('products.name')
        ->orderByRaw('SUM(order_product.quantity) DESC')
        ->first();

        $worst_selling_product = Product::select('products.name')
        ->join('order_product', 'products.id', '=', 'order_product.product_id')
        ->join('orders', 'order_product.order_id', '=', 'orders.id')
        ->where('is_paid', true)
        ->whereHas('restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })
        ->whereMonth('orders.created_at', Carbon::now()->month)
        ->groupBy('products.name')
        ->orderByRaw('SUM(order_product.quantity) ASC')
        ->first();

        // charts data
        $incomes_by_day = Order::selectRaw('DAY(created_at) as day, SUM(total_amount) as incomes')
        ->where('is_paid', true)
        ->whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })
        ->groupBy('day')
        ->get();

        $incomes_by_month = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as incomes')
        ->where('is_paid', true)
        ->whereYear('created_at', Carbon::now()->year)
        ->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })
        ->groupBy('month')
        ->get();

        $daily_data = $incomes_by_day->map(function ($item) {
            return [
                'day' => $item->day,
                'incomes' => $item->incomes,
            ];
        });

        $monthly_data = $incomes_by_month->map(function ($item) {
            return [
                'month' => $item->month,
                'incomes' => $item->incomes,
            ];
        });

        return view('stats', compact('day_income','month_income', 'year_income', 'total_income', 'best_selling_product', 'worst_selling_product', 'daily_data', 'monthly_data'));
    }
}