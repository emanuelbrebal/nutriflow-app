<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function redirectMyDashboard()
    {
        $user = Auth::user();
        $user->load(['patient.activeProtocol.meals']);

        return Inertia::render('User/MyDashboard', [
            'user' => $user
        ]);
    }
    public function redirectOnboardingForm()
    {
        // $user = User::where('id', $id)->get();
        // utilizar middleware de autenticação
        // passar os dados e relacionamentos do usuário
        return Inertia::render('User/OnboardingForm');
    }
    public function redirectMyProfile()
    {

        return Inertia::render('User/MyProfile');
    }
}
