<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function redirectMyDashboard()
    {
        // $user = User::where('id', $id)->get();
        // utilizar middleware de autenticação
        // passar os dados e relacionamentos do usuário
        return Inertia::render('User/MyDashboard');
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
        // $user = User::where('id', $id)->get();
        // utilizar middleware de autenticação
        // passar os dados e relacionamentos do usuário
        return Inertia::render('User/MyProfile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
