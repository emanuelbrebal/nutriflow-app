<?php

namespace App\Services;

use App\Enums\AccountTypeEnum;
use App\Enums\PlanLevelEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Tenta autenticar o usuário com as credenciais fornecidas.
     */
    public function authenticate(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }

    /**
     * Cria um novo usuário e define os padrões do sistema.
     */
    public function registerUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            
            'account_status' => StatusEnum::Incomplete,
            'mobile_number' => null,
            'plan_level' => PlanLevelEnum::Free,
        ]);
    }

    /**
     * Realiza o logout do usuário no Guard padrão.
     */
    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}