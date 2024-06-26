<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login');
        }
        elseif($user->type=='admin'){
            return redirect()->route('adminDashboard');
        }
        elseif($user->type=='company'){
            return redirect()->route('companyDashboard');
        }
        
        return $next($request);
    }
}
