<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        $month_income = Order::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total_amount');

        return view('home', compact('orders', 'month_income'));
    }
}
