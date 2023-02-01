<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CustomAuth\AdminLoginController;
use Closure;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     protected $login;

     function __construct(AdminLoginController $login)
     {
         Auth::shouldUse('admin');
         $this->login = $login;
     }

     public function handle($request, Closure $next)
     {

         Auth::guard('admin');

         if(!Auth::guard('admin')->check()) {
             if (!strstr($request->url(), 'login')) {
                 return redirect()->route('admin.login');
             }
         }

         return $next($request);

     }
}
