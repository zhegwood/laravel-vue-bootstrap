<?php

namespace App\Http\Middleware;

use Closure;

class Authenticated
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
        if (auth()->check()) {
            return $next($request);
        }

        if ($request->ajax()) {
            return response((object) [
                'error' => 'expired',
                'success' => false,
            ], 302);
        }

        return redirect('/login');
    }
}
