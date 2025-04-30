<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRequest extends FormRequest
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
            'libelle' => 'required|string|max:255',
            'immatriculation' => 'required|string|unique:buses,immatriculation,'.$this->bus->id,
            'type' => 'required|in:vip,standard',
            'nombre_place' => 'required|integer|min:1',
            'agence_id' => 'required|exists:agences,id',
            'photo_interieur' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'photo_exterieur' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(){
        return[
            'libelle.required'=>'Champ obligatoire',
            'immatriculation.required'=>'Champ obligatoire',
            'immatriculation.unique'=>'L\'immatriculation doit être unique',
            'type.required'=>'Champ obligatoire',
            'nombre_place.required'=>'Champ obligatoire',
            'nombre_place.min'=>'Minimun 1 place',
            'agence_id.required'=>'Champ obligatoire',
            'photo_interieur.max'=>'La taille maximale requise est 2 MB',
            'photo_exterieur.max'=>'La taille maximale requise est 2 MB',
            'photo_exterieur.required'=>'Champ est obligatoire',
        ];
    }
}
