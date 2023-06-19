<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {
        return $next($request);
    }

    return redirect()->guest('login')->withErrors('Silahkan Login terlebih dahulu');
}
    // $path = $request->path();

    // $authenticationSuccessful = null;
    // // Check if the current path is "Beranda" and if the user is not authenticated
    // if ($path === 'Beranda' && $authenticationSuccessful) {
    //     return redirect('/login');
    // } else{
    //     return redirect('/Beranda');
    // }



}
