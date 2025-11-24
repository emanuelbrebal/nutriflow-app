<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

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
        if (! $this->authService->authenticate($request->email, $request->password, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais fornecidas estão incorretas.',
            ]);
        }

        $request->session()->regenerate();

        return $this->redirectBasedOnRole(Auth::user());
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->registerUser($request->validated());

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectBasedOnRole($user);
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.redirect');
    }

    /**
     * Helper privado para centralizar a lógica de redirecionamento pós-login/registro.
     */
    private function redirectBasedOnRole($user)
    {
        if ($user->account_type == AccountTypeEnum::Patient) {
            return redirect()->route('user.my-dashboard')
                ->with('success', "Bem-vindo de volta, usuário!");
        }

        return redirect()->route('nutritionist.my-patients')
            ->with('success', "Bem-vindo de volta, nutricionista!");
    }
}