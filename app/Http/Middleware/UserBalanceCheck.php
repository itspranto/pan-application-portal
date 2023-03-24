<?php

namespace App\Http\Middleware;

use Closure;

class UserBalanceCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->balance < env("PROCESSING_FEE")) {
            return redirect('/pans/insufficient_balance');
        }
        return $next($request);
    }
}
