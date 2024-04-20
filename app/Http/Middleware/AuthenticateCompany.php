<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateCompany
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
            redirect()->route('login');
        }
        elseif($user->type=='student'){
            redirect()->route('dashboard');
        }
        elseif($user->type=='admin'){
            redirect()->route('adminDashboard');
        }

        return $next($request);
    }
}
