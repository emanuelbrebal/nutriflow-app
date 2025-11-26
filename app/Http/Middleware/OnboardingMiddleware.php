<?php

namespace App\Http\Middleware;

use App\Enums\AccountTypeEnum;
use App\Enums\StatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnboardingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();

        if ($user->account_status == StatusEnum::Incomplete) {
            $routeName = '';
            if ($user->account_type == AccountTypeEnum::Patient) {
                $routeName = 'user.onboarding-form';
            }

            if ($user->account_type == AccountTypeEnum::Nutritionist) {
                $routeName = 'nutritionist.onboarding-form';
            }

            return redirect()->route($routeName)->with(['error', 'Por favor, complete seu cadastro primeiro!']);
        }

        return $next($request);
    }
}
