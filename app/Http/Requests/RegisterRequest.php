<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class RegisterRequest extends FormRequest
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
    

    // incluir a regra de itens unicos para email quando criar a tabela no banco
    public function rules(): array
    {
        return [
            'account_type' => 
            [
                'required',
                'string',
                Rule::in(['nutricionista', 'paciente', 'aluno']),

            ],
            'email' => 'required|string|email|max:255',
            'code' => 
            [
                'required_if:account_type,paciente',
                'nullable', 
                'digits:6',
                Rule::exists('users', 'referral_code')

            ],
            'name' => 'required|integer|digits:6',
            'password' => 'required|string|min:6'
        ];
    }
    public function messages(): array
    {
        return [
            'account_type.required' => "O campo 'Eu sou...' é obrigatório.",
            'account_type.in' => 'Por favor, selecione um tipo de conta válido.',

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O endereço de e-mail informado não é válido.',
            'email.string' => 'O endereço de e-mail deve ser um conjunto de caracteres.',
            'email.unique' => 'Este e-mail já está em uso. Por favor, tente outro.',

            'code.required_if' => 'O código do nutricionista é obrigatório para pacientes.',
            'code.digits' => 'O campo do código é composto por exatamente 6 dígitos.',
            'code.exists' => 'O código informado é inválido ou não foi encontrado.',

            'password.required' => 'Por favor, informe sua senha.',
            'password.string' => 'A senha deve ser um conjunto de caracteres',
            'password.min' => 'A senha precisa ter no mínimo 6 caracteres',
        ];
    }
}
