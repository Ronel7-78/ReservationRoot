<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrajetRequest extends FormRequest
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
        'ville_depart' => 'required|string|max:255',
        'ville_arrivee' => 'required|string|max:255|different:ville_depart',
        'standing' => 'required|in:vip,classique',
        'prix' => 'required|numeric|min:0'
        ];
    }
}
