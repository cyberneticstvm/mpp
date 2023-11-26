<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsProfileSelected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->get('profile') > 0) :
            return $next($request);
        endif;
        return redirect()->route('dashboard')->withError('Error! You dont have an active profile selected. Please logout and login again to choose the profile.!');
    }
}
