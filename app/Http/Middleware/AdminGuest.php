<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin as AdminModel;
class AdminGuest
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
        if (AdminModel::isAdmin()) {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
