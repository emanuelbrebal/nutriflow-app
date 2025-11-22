<?php

namespace App\Http\Middleware;

use App\Enums\PlanLevelEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IntermediatePlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->user()->plan_level == PlanLevelEnum::Free) {
            return $next($request);
        }
        return redirect()->route('plans.upgrade')->withMessages(['error' => 'Você precisa fazer o upgrade de seu plano para continuar!']);
    }
}
