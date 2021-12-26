<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AgeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();
        $request->session()->put('game-detail', $url);
        if(! $request->session()->has('age')) return redirect()->route('age');

        $age = $request->session()->pull('age');
        if($age < 17) return redirect()->route('index')->withErrors("You need to be at least 17 to access this page");

        return $next($request);
    }
}
