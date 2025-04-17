<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true; // À modifier selon votre système d'autorisation
    }

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => 'required',
        ];
    }
}