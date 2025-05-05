<?php

namespace App\Http\Requests;

use App\Models\Voyage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'voyage_id' => [
                'required',
                'exists:voyages,id',
                function ($attribute, $value, $fail) {
                    $voyage = Voyage::find($value);
                    if ($voyage->date_depart < now()) {
                        $fail('Ce voyage est déjà parti');
                    }
                }
            ],
            'numero_siege' => [
                'required',
                'integer',
                'min:2',
                Rule::unique('reservations')->where(function ($query) {
                    return $query->where('voyage_id', $this->voyage_id);
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'numero_siege.unique' => 'Ce siège est déjà réservé pour ce voyage'
        ];
    }
}
