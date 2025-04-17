<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Middleware\ThrottleRequests;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Vérifie les tentatives excessives
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $redirect = match ($user->role) {
                'admin' => route('Admin.dashboard'),
                'agence' => route('Agence.dashboard'),
                'client' => route('Client.home'),
                default => '/',
            };

            return redirect()->intended($redirect)->with('success', 'Bienvenue, Vous êtes connecté 😊');
        }

        $this->incrementLoginAttempts($request);
        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Vous êtes déconnecté avec succès.');
    }

    protected function username()
    {
        return 'email';
    }

    // Ajoutez ces méthodes pour gérer les tentatives de connexion
    protected function hasTooManyLoginAttempts(Request $request)
    {
        // Logique pour vérifier les tentatives de connexion
    }

    protected function incrementLoginAttempts(Request $request)
    {
        // Logique pour incrémenter les tentatives de connexion
    }

    protected function clearLoginAttempts(Request $request)
    {
        // Logique pour nettoyer les tentatives
    }

    protected function sendLockoutResponse(Request $request)
    {
        // Logique pour gérer la réponse de verrouillage
    }
}