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
        })->paginate(15);

        $day_profit = Order::where('is_paid', true)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->whereHas('products.restaurant.user', function ($query) use ($user_id) {
            $query->where('users.id', $user_id);
        })->sum('total_amount');

        // daily income chart data 
        $day_income = Order::selectRaw('DAY(created_at) as day, SUM(total_amount) as incomes')
            ->where('is_paid', true)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereHas('products.restaurant.user', function ($query) use ($user_id) {
                $query->where('users.id', $user_id);
            })
            ->groupBy('day')
            ->get();

                    // Trasforma i risultati in un array nel formato desiderato
        $daily_data = $day_income->map(function ($item) {
            return [
                'day' => $item->day,
                'incomes' => $item->incomes,
            ];
        });
        // Raggruppa gli ordini per anno e calcola il conteggio di ciascun gruppo
        $month_income = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as incomes')
            ->where('is_paid', true)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereHas('products.restaurant.user', function ($query) use ($user_id) {
                $query->where('users.id', $user_id);
            })
            ->groupBy('month')
            ->get();

        // Trasforma i risultati in un array nel formato desiderato
        $monthly_data = $month_income->map(function ($item) {
            return [
                'month' => $item->month,
                'incomes' => $item->incomes,
            ];
        });

        return view('home', compact('orders', 'month_income', 'daily_data', 'monthly_data', 'day_profit'));
    }
}