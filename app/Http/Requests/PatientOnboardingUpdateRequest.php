<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientOnboardingUpdateRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],

            'profile_picture' => ['nullable', 'image', 'max:5120'],
            'mobile_number' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'biological_sex' => ['nullable', 'string'],
            'height' => ['nullable', 'numeric', 'min:50', 'max:240'],
            'weight' => ['nullable', 'numeric', 'min:20', 'max:500'],
            'main_objective' => ['nullable', 'string'],
            'activity_level' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'numeric' => 'Este campo deve conter apenas números.',
            'date' => 'Por favor, insira uma data válida.',
            'string' => 'Este campo deve ser um texto.',

            'profile_picture.image' => 'O arquivo enviado deve ser uma imagem (jpg, png).',
            'profile_picture.max' => 'A foto de perfil não pode ter mais de 5MB.',

            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',

            'biological_sex.in' => 'Selecione uma opção válida para o sexo biológico.',

            'height.min' => 'A altura mínima permitida é 50cm.',
            'height.max' => 'A altura máxima permitida é 240cm.',

            'weight.min' => 'O peso mínimo permitido é 20kg.',
            'weight.max' => 'O peso máximo permitido é 500kg.',
        ];
    }
}
