<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Agence;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /** Creer les agences */
    public function createAgence()
{
    return view('Users/Agences.form');
}

    public function storeAgence(StoreAgenceRequest $request)
    {
        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->nom_commercial,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agence',
            'telephone' => $request->telephone
        ]);

        // Gestion du logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('agences/logos', 'public');
        }

        // Création de l'agence
        Agence::create([
            'user_id' => $user->id,
            'nom_commercial' => $request->nom_commercial,
            'code_agence' => $request->code_agence,
            'logo' => $logoPath,
            'localisation' => $request->localisation,
            'devise' => $request->devise,
            'is_verified' => true
        ]);

        return redirect()->route('Admin.dashboard')
            ->with('success', 'Agence créée avec succès!');
    }
    /**
     * Tableau de bord
     */
    public function dashboard(){
        return view('Users/Admins.Dashbord');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin=Admin::all();
        return view('Users/Admins.form',compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        // Création de l'utilisateur admin
        $user = User::create([
            'name' => $request->nom . ' ' . $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'telephone' => $request->telephone,
        ]);

        // Création du profil admin
        Admin::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
