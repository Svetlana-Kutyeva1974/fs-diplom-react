<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin2
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
           $user= Auth::user();
           //$password = Auth::user()->getAuthPassword();
            if (!$user->is_admin) {
              abort( 403);
            }
        return $next($request);


             //if (Auth::attempt(['email' => $user['email'], 'password' => $password])) {
      // Аутентификация успешна
      //return redirect()->intended('dashboard');}//Auth::logout();
    }
}
