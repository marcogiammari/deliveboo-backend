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

        // ----------------- //
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

        // var_dump($day_income);
        // var_dump($month_income);
        // var_dump($year_income);
        // var_dump($total_income);
        // var_dump($best_selling_product);
        // var_dump($worst_selling_product);

        return view('stats', compact('day_income','month_income', 'year_income', 'total_income', 'best_selling_product'));
    }
}