<?php

namespace App\Http\Middleware;

use App\Models\Restaurant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRestaurantOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $restaurant = $request->route('restaurant');
        
        if ( !$restaurant || $restaurant->user_id !== Auth::user()->id) {
            return abort(403, 'Accesso negato');
        }

        return $next($request);
    }
}
