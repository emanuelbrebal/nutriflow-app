<?php

namespace App\Http\Controllers;

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
}
