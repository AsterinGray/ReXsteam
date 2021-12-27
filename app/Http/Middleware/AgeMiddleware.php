<?php

namespace App\Http\Middleware;

use App\Models\Game;
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
        $id = $request->route()->id;
        $game = Game::find($id);

        if($game->for_adult) {
            $request->session()->put('game-detail', $id);
            if(! $request->session()->has('age')) return redirect()->route('age');

            $age = $request->session()->pull('age');
            if($age < 17) return redirect()->route('index')->withErrors("You need to be at least 17 to access this page");
        }

        return $next($request);
    }
}
