<?php

namespace App\Http\Requests;

use App\Enums\NutritionistSpecialtyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NutritionistOnboardingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mobile_number' => ['required', 'string', 'max:20'],
            'crn' => ['required', 'string', 'max:20'],
            'specialty' => ['required', Rule::enum(NutritionistSpecialtyEnum::class)],
            'profile_picture' => ['nullable', 'image', 'max:2048'], 
        ];
    }

    public function attributes(): array
    {
        return [
            'mobile_number' => 'número de celular',
            'crn' => 'CRN',
            'specialty' => 'especialidade',
            'profile_picture' => 'foto de perfil',
        ];
    }
}