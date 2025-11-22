<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Enums\PlanLevelEnum;
use App\Enums\StatusEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function redirectLogin()
    {
        return Inertia::render('Login/Login');
    }
    public function redirectRegister()
    {
        return Inertia::render('Login/Register')
            ->with(['accountTypes' => AccountTypeEnum::options()]);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais fornecidas estão incorretas.',
            ]);
        }

        $request->session()->regenerate();


        $user = Auth::user();

        if ($user->account_type == AccountTypeEnum::Patient) {
            return redirect()->intended(route('user.my-dashboard'))
                ->withMessages('success', "Bem-vindo de volta, usuário!");
        }

        return redirect()->intended(route('nutritionist.my-patients'))
            ->withMessages('success', "Bem-vindo de volta, nutricionista!");
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,

            'account_status' => StatusEnum::Incomplete,

            'mobile_number' => null,
            'plan_level' => PlanLevelEnum::Free,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.my-dashboard')
            ->withMessages('success', "Conta criada com sucesso! Seu código é: " . $user->user_code);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.redirect');
    }
}
