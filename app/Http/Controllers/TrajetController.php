<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
use App\Models\Trajet;
use Illuminate\Http\Request;

class TrajetController extends Controller
{

    public function create()
    {
        return view('Users/Agences/Trajets.create');
    }

    public function store(StoreTrajetRequest $request)
    {
        Trajet::create($request->validated());
         
        return redirect()->route('Agence.dashboard')
            ->with('success', 'Trajet créé avec succès!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenceId = auth()->user()->agence->id;
    
        // Récupérer les trajets via les bus de l'agence
        $trajets = Trajet::whereHas('voyages.bus', function($query) use ($agenceId) {
            $query->where('agence_id', $agenceId);
        })
        ->withCount(['voyages' => function($query) use ($agenceId) {
            $query->whereHas('bus', fn($q) => $q->where('agence_id', $agenceId));
        }])
        ->get();
    
        return view('Users/Agences/Trajets.index', compact('trajets'));
    }

    // app/Models/Trajet.php
public function scopeForAgence($query, $agenceId)
{
    return $query->whereHas('voyages.bus', function($q) use ($agenceId) {
        $q->where('agence_id', $agenceId);
    });
}

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
