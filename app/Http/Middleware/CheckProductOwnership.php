<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProductOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $product = $request->route('product');
        $restaurant = Restaurant::find($product->restaurant_id);
        
        if ( !$restaurant || $restaurant->user_id !== Auth::user()->id) {
            return abort(403, 'Accesso negato');
        }

        return $next($request);
    }
}
