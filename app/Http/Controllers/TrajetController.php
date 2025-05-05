<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
use App\Http\Requests\UpdateTrajetRequest;
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
        Trajet::create([
            ...$request->validated(),
            'agence_id' => auth()->user()->agence->id
        ]);

        return redirect()->route('Agence.dashboard')
            ->with('success', 'Trajet créé avec succès!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenceId = auth()->user()->agence->id;

        $trajets = Trajet::where('statut', 'Actif') // Filtre statut
        ->whereHas('voyages.bus', function($query) use ($agenceId) {
            $query->where('agence_id', $agenceId)
                  ->where('statut', 'Actif'); // Buses actifs
        })
        ->withCount(['voyages' => function($query) use ($agenceId) {
            $query->whereHas('bus', fn($q) => $q->where('agence_id', $agenceId))
                  ->where('statut', 'Actif'); // Voyages actifs
        }])
        ->get();

    return view('Users/Agences/Trajets.index', compact('trajets'));
    }

    // app/Models/Trajet.php

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
        $agenceId = auth()->user()->agence->id;

        $trajets = Trajet::where('statut', 'Actif') // Filtre statut
        ->whereHas('voyages.bus', function($query) use ($agenceId) {
            $query->where('agence_id', $agenceId)
                  ->where('statut', 'Actif'); // Buses actifs
        })
        ->withCount(['voyages' => function($query) use ($agenceId) {
            $query->whereHas('bus', fn($q) => $q->where('agence_id', $agenceId))
                  ->where('statut', 'Actif'); // Voyages actifs
        }])
        ->get();

    return view('Users/Agences/Trajets.Edit', compact('trajets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrajetRequest $request, Trajet $trajet)
    {
        $validated = $request->validated();
    $validated['agence_id'] = $trajet->agence_id;

    $trajet->update($validated);

    return redirect(route('Agence.Trajets.index'))->with('success', 'Trajet modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
    $trajet = Trajet::findOrFail($id);

    if ($trajet->voyages()->where('statut', 'Actif')->exists()) {
        return back()->with('error',
            'Ce trajet a des voyages actifs. Désactivez-les d\'abord.');
    }

    $trajet->update(['statut' => 'Inactif']);

    return back()->with('success', 'Trajet désactivé');
    }
}
