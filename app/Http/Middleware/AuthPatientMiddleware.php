<?php

namespace App\Http\Middleware;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
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
        $user = Auth::guard('web')->user();
        if ($user->account_status != StatusEnum::Inactive) {
            if ($user && $user->account_type == AccountTypeEnum::Patient) {
                return $next($request);
            }
            return redirect()->route('login.redirect')->with(['error' => 'Acesso negado!']);
        }

        return redirect()->route('login.redirect')->with(['error' => 'Essa conta está desativada.']);
    }
}
