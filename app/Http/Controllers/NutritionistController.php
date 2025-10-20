<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NutritionistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function redirectMyPatients()
    {
        // passar os pacientes com seus relacionamentos
        return Inertia::render('Nutritionist/MyPatients');
    }
    public function redirectSetNewEvaluation()
    {
        // passar os pacientes com seus relacionamentos
        return Inertia::render('Nutritionist/EvaluationsForm');
    }
    public function redirectSetNewDietaryProtocol()
    {
        // passar os pacientes com seus relacionamentos
        return Inertia::render('Nutritionist/DietBuilder');
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
