<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Agence;
use App\Models\Reservation;
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
        public function dashboard()
    {
        $stats = [
            'agenceCount' => Agence::count(),
            'clientCount' => User::where('role', 'client')->count(),
            'adminCount' => Admin::count(),
            'reservationCount' => Reservation::count(), // Supposons que vous avez un modèle Reservation
            'agences' => Agence::latest()->take(5)->get(),
            'activities' => $this->getRecentActivities()
        ];

        return view('Users/Admins.Dashbord', $stats);
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Dernières agences
        Agence::latest()->take(3)->get()->each(function ($agence) use ($activities) {
            $activities->push([
                'icon' => 'fas fa-building',
                'title' => "Nouvelle agence enregistrée : {$agence->nom_commercial}",
                'date' => $agence->created_at
            ]);
        });

        // Derniers clients
        User::where('role', 'client')->latest()->take(3)->get()->each(function ($user) use ($activities) {
            $activities->push([
                'icon' => 'fas fa-user-plus',
                'title' => "Nouveau client inscrit : {$user->name}",
                'date' => $user->created_at
            ]);
        });

        // Dernières réservations
        Reservation::latest()->take(3)->get()->each(function ($reservation) use ($activities) {
            $activities->push([
                'icon' => 'fas fa-ticket-alt',
                'title' => "Nouvelle réservation #{$reservation->id}",
                'date' => $reservation->created_at
            ]);
        });

        return $activities->sortByDesc('date')->take(5);
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
