<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UnlinkedPatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();
        if(!isset($user->patient->linked_nutritionist)){
            return redirect()->route('user.link_nutritionist')->with(['error', 'Você precisa se vincular a um nutricionista primeiro!']);
        }
        return $next($request);
    }
}
