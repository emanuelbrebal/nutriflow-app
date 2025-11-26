<?php

namespace App\Http\Controllers;

use App\Enums\NutritionistSpecialtyEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CodeLinkRequest;
use App\Http\Requests\NutritionistOnboardingRequest;
use App\Services\NutritionistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class NutritionistController extends Controller
{
    public function __construct(
        protected NutritionistService $nutritionistService
    ) {}

    public function redirectOnboardingForm()
    {
        return Inertia::render('Nutritionist/OnboardingForm', [
            'user' => Auth::user(),
            'enums' => [
                'specialties' => NutritionistSpecialtyEnum::options()
            ]
        ]);
    }

    public function fillOnboardingForm(NutritionistOnboardingRequest $request)
    {
        $userData = [
            'mobile_number' => $request->mobile_number
        ];

        $nutritionistData = [
            'crn' => $request->crn,
            'specialty' => $request->specialty
        ];

        $this->nutritionistService->updateProfile(
            user: Auth::user(),
            userData: $userData,
            nutritionistData: $nutritionistData,
            photo: $request->file('profile_picture'),
            activateAccount: true 
        );

        return redirect()->route('nutritionist.my-patients')
        ->with(['success', 'Perfil profissional configurado com sucesso!']);
    }

    public function redirectMyPatients()
    {
        $user = Auth::user();
        
        $user->load(['nutritionist.patients.user']);

        $patients = $user->nutritionist?->patients ?? [];

        return Inertia::render('Nutritionist/MyPatients', [
            'user' => $user,
            'patients' => $patients
        ]);
    }

    public function linkPatient(CodeLinkRequest $request)
    {

        $result = $this->nutritionistService->linkPatient(
            Auth::user(), 
            $request->input('code')
        );

        if (!$result['success']) {
            return back()->withErrors(['patient_identifier' => $result['message']]);
        }

        return back()->with([
            'success' => true,
            'message' => "Paciente {$result['patient_name']} vinculado com sucesso!"
        ]);
    }


    public function unlinkPatient(int $patientUserId)
    {
        $result = $this->nutritionistService->unlinkPatient(Auth::user(), $patientUserId);

        if (!$result['success']) {
            return back()->withErrors(['error' => $result['message']]);
        }

        return back()->with([
            'success' => true,
            'message' => 'Paciente removido da sua lista.'
        ]);
    }


    public function redirectSetNewEvaluation()
    {
        return Inertia::render('Nutritionist/EvaluationsForm');
    }

    public function redirectSetNewDietaryProtocol()
    {
        return Inertia::render('Nutritionist/DietBuilder');
    }

    public function updateMyProfile(Request $request)
    {
        $userData = $request->only([
            'name', 
            'mobile_number'
        ]);

        $nutritionistData = $request->only([
            'crn',
            'specialty',
        ]);

        $this->nutritionistService->updateProfile(
            Auth::user(),
            $userData,
            $nutritionistData,
            $request->file('profile_picture')
        );

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }
}