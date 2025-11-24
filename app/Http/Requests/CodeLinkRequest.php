<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeLinkRequest extends FormRequest
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
            'code' => 'required|string|size:6|exists:users,user_code',
        ];
    }

    public function messages(): array
    {
        return [
            'code.exists' => 'Não encontramos nenhum nutricionista com este código.',
            'code.size' => 'O código deve ter exatamente 6 caracteres.'
        ];
    }
}
