<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = Order::latest()->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->get();

        $month_income = Order::where('is_paid', true)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

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

        
        // $months = null;
        // $incomes = null;

        // $data = [
        //     'mese' => 'income',
        //     'mese' => 'income',
        //     'mese' => 'income',
        //     'mese' => 'income',
        // ];

            // const data = [
            //     { year: 2010, count: 10 },
            //     { year: 2011, count: 20 },
            //     { year: 2012, count: 15 },
            //     { year: 2013, count: 25 },
            //     { year: 2014, count: 22 },
            //     { year: 2015, count: 30 },
            //     { year: 2016, count: 28 },
            //   ];
        
        return view('home', compact('orders', 'month_income', 'best_selling_product'));
    }
}