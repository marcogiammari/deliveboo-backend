<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckProductAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((!auth()->user()->restaurant)) {
            return redirect()->route("restaurants.create")->with('flash', 'Devi aggiungere un ristorante prima di visualizzare i prodotti!');
        }
        return $next($request);
    }
}
