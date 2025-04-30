<?php

namespace App\Http\Requests;

use App\Models\Bus;
use App\Models\Voyage;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoyageRequest extends FormRequest
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
    // app/Http/Requests/StoreVoyageRequest.php
    public function rules()
    {
        return [
            'trajet_id' => 'required|exists:trajets,id',
            'bus_id' => [
                'required',
                'exists:buses,id',
                function ($attribute, $value, $fail) {
                    $dateOnly = \Carbon\Carbon::parse($this->date_depart)->format('Y-m-d');
                    $exists = Voyage::where('bus_id', $value)
                        ->whereDate('date_depart', $dateOnly)
                        ->exists();

                    if ($exists) {
                        $fail('Ce bus a déjà un voyage programmé pour cette date');
                    }
                }
            ],
            'date_depart' => 'required|date|after_or_equal:now'
        ];
    }

    public function messages()
    {
        return [
            'trajet_id.required' => 'Le champ trajet est obligatoire.',
            'trajet_id.exists' => 'Le trajet sélectionné n\'existe pas.',

            'bus_id.required' => 'Le champ bus est obligatoire.',
            'bus_id.exists' => 'Le bus sélectionné n\'existe pas.',
            'date_depart.required' => 'Le champ date de départ est obligatoire.',
            'date_depart.date' => 'Veuillez entrer une date valide.',
            'date_depart.after' => 'La date de départ doit être une date future.',
        ];
    }
}
