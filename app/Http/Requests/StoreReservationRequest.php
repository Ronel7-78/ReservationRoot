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
            'voyage_id' => 'required|exists:voyages,id',
            'numero_siege' => 'required|integer|min:1'

        ];
    }

    public function messages()
    {
        return [
            'numero_siege.unique' => 'Ce siège est déjà réservé pour ce voyage'
        ];
    }
}
