<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function redirectLogin()
    {
        return Inertia::render('Login/Login');
    }
    public function redirectRegister()
    {
        return Inertia::render('Login/Register');
    }

    public function login(LoginRequest $request){
        //login unificado apenas ajustando a rota para caso o usuário seja paciente ou nutricionista, verificando o $request->account_type
        return redirect()->route('user.my-dashboard')->with('success', "Usuário autenticado com sucesso!");
    }

    public function register(RegisterRequest $request){
        //assim como o login, o registro é unificado apenas ajustando a rota para caso o usuário seja paciente ou nutricionista, verificando o $request->account_type

        return redirect()->route('user.my-dashboard')->with('success', "Usuário se cadastrou com sucesso!");
    }

    public function logout(){
        return redirect()->route('login.redirect')->with('success', "Usuário encerrou a sessão com sucesso!");
    }
}
