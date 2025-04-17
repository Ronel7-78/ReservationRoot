<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('Users/Clients.registerClient');
    }

    public function register(StoreClientRequest $request)
    {
        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
            'telephone' => $request->telephone
        ]);

        // Création du profil client
        Client::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'cni' => $request->cni,
            'sexe' => $request->sexe
        ]);

        // Connexion automatique
        auth()->login($user);

        return redirect()->route('home')
            ->with('success', 'Inscription réussie ! Bienvenue 😊');
    }
}
