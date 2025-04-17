<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusRequest extends FormRequest
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
    public function rules(){
    
    return [
        'libelle' => 'required|string|max:255',
        'immatriculation' => 'required|string|unique:buses',
        'type' => 'required|in:vip,standard',
        'nombre_place' => 'required|integer|min:1',
        'agence_id' => 'required|exists:agences,id',
        'photo_interieur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'photo_exterieur' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ];
    }
}
