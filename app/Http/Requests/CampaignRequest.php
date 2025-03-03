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
            'Number' => 'required|integer|min:1',
            'CEP' => 'required|string|regex:/^[0-9]{5}-[0-9]{3}$/', // Formato do CEP
            'Data' => 'required|date|after:now', // Data deve ser futura
            'Hour' => 'required|date_format:H:i',
            'meta' => 'required|integer|min:1|max:500',
            'Image' => 'required|image|mimes:jpeg,jpg,png,svg| max:2048'
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
            'Number.min' => 'O número deve ser positivo',
            'CEP.required' => 'O CEP é obrigatório.',
            'CEP.regex' => 'O CEP deve estar no formato 00000-000.',
            'Data.required' => 'A data é obrigatória.', 
            'Data.after' => 'A data deve ser uma data futura.',
            'Hour.required' => 'A hora é obrigatória.',
            'meta.integer' => 'A meta deve ser um número inteiro.',
            'meta.required' => 'A meta é obrigatória.',
            'meta.min' => 'A meta deve ser pelo menos 1.',
            'meta.max' => 'A meta não pode exceder 500 kg.',
            'Image.required' => 'A campanha deve possuir uma imagem.',
            'Image.image' => 'O arquivo deve ser uma imagem.',
            'Image.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg.',
            'Image.max' => 'A imagem não pode exceder 2MB.',
        ];
    }
}
