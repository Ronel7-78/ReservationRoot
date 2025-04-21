<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoyageRequest;
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
        $voyages = Voyage::with(['bus', 'trajet'])
        ->whereHas('bus', function($query) {
            $query->where('agence_id', auth()->user()->agence->id);
        })
        ->get();

    return view('Users/Agences/Voyages.index', compact('voyages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agenceId = auth()->user()->agence->id;
        $agenceno =auth()->user()->agence->nom_commercial ;

        return view('Users/Agences/Voyages.create', [
            'trajets' => Trajet::all(),
            'buses' => Bus::where('agence_id', $agenceId)
                        ->where('statut', 'disponible')
                        ->get(),
                        'agences'=>Agence::all()
        ]);
    }

    public function store(StoreVoyageRequest $request){
        $voyage = Voyage::create($request->validated());

        // Mise à jour du statut du bus
        $voyage->bus()->update(['statut' => 'indisponible']);

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
