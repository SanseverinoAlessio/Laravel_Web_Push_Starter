<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsLogged{
    public function handle($request, Closure $next){
        if(!Auth::check())
            return redirect()->to('login');
    
        return $next($request);
    }
}