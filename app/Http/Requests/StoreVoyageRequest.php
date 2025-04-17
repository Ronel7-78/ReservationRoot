<?php

namespace App\Http\Requests;

use App\Models\Bus;
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
        'heure_depart'=>'required',
        'bus_id' => [
            'required',
            'exists:buses,id',
            function ($attribute, $value, $fail) {
                $bus = Bus::find($value);
                $dateDepart = $this->input('date_depart');

                if ($bus->voyages()->whereDate('date_depart', $dateDepart)->exists()) {
                    $fail('Ce bus est déjà affecté à un voyage ce jour-là');
                }
            }
        ],
        'date_depart' => 'required|date|after:now'
    ];
}
}
