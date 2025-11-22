<?php

namespace App\Http\Middleware;

use App\Enums\AccountTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthPatientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->user()->account_type == AccountTypeEnum::Patient) {
            return $next($request);
        }

        return redirect()->back()->withMessages(['error' => 'Acesso negado!']);
    }
}
