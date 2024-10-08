<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
            'Title' => 'required|string|max:50',
            'Description' => 'required|string|max:1000',
            'State' => 'required|string',
            'City' => 'required|string',
            'Street' => 'required|string',
            'Number' => 'required|string',
            'CEP' => 'required|string|regex:/^[0-9]{5}-[0-9]{3}$/', // Formato do CEP
            'Data' => 'required|date|after:now', // Data deve ser futura
            'meta' => 'nullable|integer|min:0|max:500', // Meta opcional
        ];
    }

    public function messages()
    {
        return [
            'Title.required' => 'O título é obrigatório.',
            'Description.required' => 'A descrição é obrigatória.',
            'State.required' => 'O estado é obrigatório.',
            'City.required' => 'A cidade é obrigatória.',
            'Street.required' => 'A rua é obrigatória.',
            'Number.required' => 'O número é obrigatório.',
            'CEP.required' => 'O CEP é obrigatório.',
            'CEP.regex' => 'O CEP deve estar no formato 00000-000.',
            'Data.required' => 'A data é obrigatória.',
            'Data.after' => 'A data deve ser uma data futura.',
            'meta.integer' => 'A meta deve ser um número inteiro.',
            'meta.min' => 'A meta deve ser pelo menos 0.',
            'meta.max' => 'A meta não pode exceder 500 kg.',
        ];
    }
}
