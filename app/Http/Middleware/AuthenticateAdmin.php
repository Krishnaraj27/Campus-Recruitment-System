<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
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
        elseif($user->type=='student'){
            return redirect()->route('dashboard');
        }
        elseif($user->type=='company'){
            return redirect()->route('companyDashboard');
        }
        
        return $next($request);
    }
}
