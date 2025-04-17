<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgenceRequest extends FormRequest
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
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'nom_commercial' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'localisation' => 'required|string',
        'devise' => 'nullable|string|max:100',
        'telephone' => 'required|string|max:20'
        ];
    }

    public function messages() {
        return [
            'nom_commercial.required' => ' Le nom commercial est requis ',
            'email.required' => 'L\'email est requis ',
            'logo.max' => 'La taille du fichier ne doit pas dépasser 2 Mo ',
            'email.unique'=>'Cette adresse mail est déjà utilisée',
            'password.required' => 'Le mot de passe est requis ',
            'password.min'=>'Le mot de passe doit contenir au moins 8 caractères',
            'devise.max'=>'La devise/Slogan ne doit pas depasser les 100 caractères',
            'localisation.required'=>'Ce champ est requis',
            'telephone.required'=> 'Le numero de téléphone est requis'


        ];
    }
}
