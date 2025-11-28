<?php

namespace App\Http\Controllers;

use App\Enums\AccountTypeEnum;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        try {
            $this->authService->authenticate($request->email, $request->password);

            $request->session()->regenerate();
            $user = Auth::user();

            return $this->redirectBasedOnRole($user);
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->only('email'))
                ->with('error', 'Credenciais incorretas.');
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->authService->registerUser($request->validated());
            Auth::login($user);
            $request->session()->regenerate();
            DB::commit();
            return $this->redirectBasedOnRole($user);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error', 'Algo deu errado ao cadastrar conta. Por favor, tente novamente.']);
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.redirect');
    }

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
