<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoyageRequest extends FormRequest
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
            'date_depart' => 'required|date|after:now',
        ];
    }

    public function attributes()
    {
        return [
            'date_depart' => 'date de départ',
        ];
    }

    public function messages()
{
    return [
        'date_depart.required' => 'Le champ date de départ est obligatoire.',
        'date_depart.date' => 'Veuillez entrer une date valide.',
        'date_depart.after' => 'La date de départ doit être une date future.',
    ];
}
}
