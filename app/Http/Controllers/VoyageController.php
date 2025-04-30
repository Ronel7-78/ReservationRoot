<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoyageRequest;
use App\Http\Requests\UpdateVoyageRequest;
use App\Models\Agence;
use App\Models\Bus;
use App\Models\Trajet;
use App\Models\Voyage;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenceId = auth()->user()->agence->id;
    
        $voyages = Voyage::where('statut', 'Actif')
            ->whereHas('bus', function($query) use ($agenceId) {
                $query->where('agence_id', $agenceId)
                      ->where('statut', 'Actif');
            })
            ->with(['trajet', 'bus'])
            ->get();
    
        return view('Users/Agences/Voyages.index', compact('voyages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){

    $agenceId = auth()->user()->agence->id;

    // Récupérer uniquement les trajets de l'agence connectée
    $trajets = Trajet::where('agence_id', $agenceId)->get();

    // Récupérer les bus de l'agence connectée
    $buses = Bus::where('agence_id', $agenceId)->get();

    return view('Users/Agences/Voyages.create', [
        'trajets' => $trajets,
        'buses' => $buses,
        'agences' => Agence::all() // Si vous avez besoin de toutes les agences
    ]);
    }

    public function store(StoreVoyageRequest $request){
    $voyage = Voyage::create($request->validated());
    return redirect()->route('Agence.dashboard')
        ->with('success', 'Voyage planifié avec succès!');
    }

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
        $agenceId = auth()->user()->agence->id;
    
        // Récupérer le voyage à modifier
        $voyage = Voyage::findOrFail($id); // Assurez-vous d'avoir le bon modèle
    
        // Récupérer uniquement les trajets de l'agence connectée
        $trajets = Trajet::where('agence_id', $agenceId)->get();
    
        // Récupérer les bus de l'agence connectée
        $buses = Bus::where('agence_id', $agenceId)->get();
    
        return view('Users/Agences/Voyages.Edit', [
            'voyage' => $voyage,
            'trajets' => $trajets,
            'buses' => $buses,
            'agences' => Agence::all() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoyageRequest $request, Voyage $voyage)
    {
        $request->merge([
            'bus_id' => $voyage->bus_id,
            'trajet_id' => $voyage->trajet_id
        ]);
    
        $voyage->update($request->validated());
        
        return redirect()->route('Agence.Voyages.index')
            ->with('success', 'Voyage mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        try {
            $voyage = Voyage::findOrFail($id);
            
            // Vérifier les réservations actives si nécessaire
            // if ($voyage->reservations()->actif()->exists()) {...}
            
            $voyage->desactiver();
            
            return back()->with('success', 'Voyage désactivé avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur: '.$e->getMessage());
        }
    }
}
