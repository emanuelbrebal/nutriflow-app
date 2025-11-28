<?php

namespace App\Http\Controllers;

use App\Enums\NutritionistSpecialtyEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CodeLinkRequest;
use App\Http\Requests\NutritionistOnboardingRequest;
use App\Services\NutritionistService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;

class NutritionistController extends Controller
{
    public function __construct(
        protected NutritionistService $nutritionistService
    ) {}


    public function redirectOnboardingForm(): InertiaResponse
    {
        return Inertia::render('Nutritionist/OnboardingForm', [
            'user' => Auth::user(),
            'enums' => [
                'specialties' => NutritionistSpecialtyEnum::options()
            ]
        ]);
    }

    public function fillOnboardingForm(NutritionistOnboardingRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

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

            DB::commit();

            return redirect()->route('nutritionist.my-patients')
                ->with('success', 'Perfil profissional configurado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocorreu um erro ao configurar o perfil. Por favor, tente novamente.');
        }
    }


    public function redirectMyPatients(): InertiaResponse
    {
        $user = Auth::user();

        $user->load(['nutritionist.patients.user']);

        $patients = $user->nutritionist?->patients ?? [];

        return Inertia::render('Nutritionist/MyPatients', [
            'user' => $user,
            'patients' => $patients
        ]);
    }


    public function linkPatient(CodeLinkRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $result = $this->nutritionistService->linkPatient(
                Auth::user(),
                $request->input('code')
            );

            $patientName = $result['patient_name'] ?? 'Nome Desconhecido';

            DB::commit();

            return back()->with('success', "Paciente: {$patientName}, vinculado com sucesso!");
        } catch (Throwable $e) {
            DB::rollBack();
            $errorMessage = 'Ocorreu um erro inesperado ao tentar vincular o paciente. Tente novamente. Detalhes: ' . $e->getMessage();

            return back()->with('error', $errorMessage);
        }
    }



    public function unlinkPatient(int $patientUserId): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->nutritionistService->unlinkPatient(Auth::user(), $patientUserId);
            DB::commit();
            return back()->with('success', 'Paciente removido da sua lista com sucesso.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocorreu um erro inesperado ao remover o paciente. Tente novamente.');
        }
    }



    public function redirectSetNewEvaluation(): InertiaResponse
    {
        return Inertia::render('Nutritionist/EvaluationsForm');
    }


    public function redirectSetNewDietaryProtocol(): InertiaResponse
    {
        return Inertia::render('Nutritionist/DietBuilder');
    }


    public function updateMyProfile(Request $request): RedirectResponse
    {
        // Se o Request não for um FormRequest, a validação deve ser feita aqui ou no Service.
        // Assumimos que o Service lida com a validação ou que um FormRequest foi omitido.
        try {
            DB::beginTransaction();

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

            DB::commit();

            return back()->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();
            // Logar o erro $e
            return back()->with('error', 'Ocorreu um erro ao atualizar o perfil. Tente novamente.');
        }
    }
}
