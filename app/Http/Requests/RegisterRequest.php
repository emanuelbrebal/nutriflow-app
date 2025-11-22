<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\AccountTypeEnum; 
use Illuminate\Validation\Rules\Enum; 

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
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'], 
            'account_type' => ['required', new Enum(AccountTypeEnum::class)],
        ];
    }
    public function messages(): array
    {
        return [
            'account_type.required' => "O campo 'Eu sou...' é obrigatório.",
            
            'account_type.enum' => 'O tipo de conta selecionado é inválido.', 

            'name.required' => "O campo 'Nome Completo' é obrigatório.",
            'name.string' => "O campo 'Nome Completo' deve ser um nome válido.",
            'name.min' => "O campo 'Nome Completo' deve ter no mínimo 2 caracteres.",
            'name.max' => "O campo 'Nome Completo' deve ter no máximo 255 caracteres.",

            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O endereço de e-mail informado não é válido.',
            'email.string' => 'O endereço de e-mail deve ser um conjunto de caracteres.',
            'email.unique' => 'Este e-mail já está em uso. Por favor, tente outro.',

            'password.required' => 'Por favor, informe sua senha.',
            'password.confirmed' => 'A confirmação da senha não confere.',
            'password.min' => 'A senha precisa ter no mínimo 6 caracteres',
        ];
    }
}
