<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteValidatorRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'campaign_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.exists' => 'Usuário não encontrado. Certifique-se de que o e-mail está correto.',

            'campaign_id.required' => 'O campo ID da campanha é obrigatório.',
        ];
    }
}
