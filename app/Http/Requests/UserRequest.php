<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Personalize a resposta para exce es de validacao.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors()
            ], 422));
    }
    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     * Os campos que devem ser validados.
     */
    public function rules(): array
    {
        $user = $this->route('user');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ( $user ? $user->id : null ),
            'password' => 'required|min:6',
        ];
    }

    /**
     * Obtenha as mensagens de validacao customizadas para as regras de validacao definidas.
     *
     * @return array<string, string> Mensagens de validacao customizadas.
     */

    public function messages()
    {
        return [
            'name.required' => 'O campo :attribute deve ser preenchido.',
            'email.required' => 'O campo :attribute deve ser preenchido.',
            'email.email' => 'O campo :attribute deve ser um email.',
            'email.unique' => 'O campo :attribute deve ser unico.',
            'password.required' => 'O campo :attribute deve ser preenchido.',
            'password.min' => 'O campo :attribute deve ter pelo menos 6 caracteres.',
        ];
    }
}
