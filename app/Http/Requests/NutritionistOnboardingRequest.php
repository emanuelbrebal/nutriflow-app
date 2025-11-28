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
            'mobile_number' => ['required', 'string', 'max:20', 'unique:users'],
            'crn' => ['required', 'string', 'regex:/^CRN-\d{1,2}\s\d+$/'],
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

    public function messages(): array
    {
        return [
            'required' => 'Este campo é obrigatório.',
            'mobile_number.unique' => 'Este número de telefone já está em uso.',
            'crn.regex' => 'Este campo deve ser preenchido conforme o exemplo: CRN-X 12345.'
        ];
    }
}