<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
    if(!session('access_token') || (time() >= session('expires_at')) || !session('permissions')){
      $request->session()->flush();
      return redirect('/login');
    }

    return $next($request);
  }
}
