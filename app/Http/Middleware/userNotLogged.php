<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class userNotLogged{
    public function handle($request, Closure $next){
        if(Auth::check())
            return redirect()->to('user/dashboard');
    
        return $next($request);
    }
}