<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
           'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'telephone' => 'required|string|max:20',
            'cni' => 'required|string|unique:clients',
            'sexe' => 'required',
        ];
    }

    public function messages() {
        return [
            'nom.required' => ' Le nom est requis ',
            'prenom.required' => 'Le prénom est requis ',
            'email.required' => 'L\'email est requis ',
            'email.unique'=>'Cette adresse mail est déjà utilisée',
            'password.required' => 'Le mot de passe est requis ',
            'password.min'=>'Le mot de passe doit contenir au moins 8 caractères',
            'cni.required' => 'Le numero de CNI est requis ',
            'cni.unique'=>'Ce numero doit être unique, choisir un autre valide',
            'sexe.required'=>'Ce champ est requis',
            'telephone.required'=> 'Le numero de téléphone est requis'


        ];
    }
}
