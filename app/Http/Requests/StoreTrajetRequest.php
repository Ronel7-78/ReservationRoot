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
        'prix' => 'required|numeric|min:0',
        'agence_id' => 'required|exists:agences,id' 
        ];
    }

    public function messages(){
        return[
            'ville_depart.required'=>'Champ obligatoire',
            'ville_depart.max'=>'Champ doit avoir moins de 255 caractères',
            'ville_arrivee.different'=>'La ville d\'arrivee doit etre differente de la ville de depart',
            'ville_arrivee.required'=>'Champ obligatoire',
            'standing.in'=>'Le standing doit etre vip ou classique',
            'prix.required'=>'Champ obligatoire',

            'prix.min'=>'Le prix doit etre superieur a 0',
            'prix.numeric'=>'Le prix doit etre numerique',
        ];
    }
}
