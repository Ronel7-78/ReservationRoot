<?php

// app/Http/Controllers/BusController.php
namespace App\Http\Controllers;

use App\Models\Bus;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Models\Agence;
use App\Models\Voyage;
use Illuminate\Http\Request;

class BusController extends Controller
{

    public function index(){
        $buses = Bus::where('agence_id', auth()->user()->agence->id)
            ->where('statut', 'Actif') // Ajout du filtre statut
            ->withCount(['voyages' => function($query) {
                $query->where('date_depart', '>', now())
                      ->where('statut', 'Actif'); // Filtre aussi les voyages actifs
            }])
            ->get();

    return view('Users/Agences/Bus.index', compact('buses'));
    }
    public function create()
    {
        $agenceId = auth()->user()->agence->id;
        return view('Users/Agences/Bus.create',[
            'agences'=>Agence::where('id', $agenceId)->get()
        ]);
    }

    public function edit(Bus $bus){
        $agenceId = auth()->user()->agence->id;
        return view('Users/Agences/Bus.Edit',[
            'agences'=>Agence::where('id', $agenceId)->get(),'bus'=>$bus
        ]);
    }

    public function store(StoreBusRequest $request)
    {
        $data = $request->validated();

        // Gestion des photos
        if ($request->hasFile('photo_interieur')) {
            $data['photo_interieur'] = $request->file('photo_interieur')
                ->store('buses/photos', 'public');
        }

        $data['photo_exterieur'] = $request->file('photo_exterieur')
            ->store('buses/photos', 'public');

        Bus::create($data);

        return redirect()->route('Agence.dashboard')
            ->with('success', 'Bus ajouté avec succès!');
    }

    public function checkDisponibilite(Request $request){
    $request->validate([
        'bus_id' => 'required|exists:buses,id',
        'date' => 'required|date'
    ]);

    $dateOnly = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
    $exists = Voyage::where('bus_id', $request->bus_id)
        ->whereDate('date_depart', $dateOnly)
        ->exists();

    return response()->json([
        'disponible' => !$exists,
        'message' => $exists
            ? 'Ce bus a déjà un voyage programmé pour cette date'
            : 'Bus disponible pour cette date'
    ]);
    }

    public function update(UpdateBusRequest $request, Bus $bus){
    // On conserve l'agence_id original
    $validated = $request->validated();
    $validated['agence_id'] = $bus->agence_id;

    $bus->update($validated);

    return redirect(route('Agence.Bus.index'))->with('success', 'Bus modifié avec succès');
}

    public function destroy($id){
        $bus = Bus::findOrFail($id);

        if ($bus->voyages()->where('statut', 'Actif')->exists()) {
            return back()->with('error', 'Ce bus a des voyages actifs. Désactivez-les d\'abord.');
        }

        $bus->update(['statut' => 'Inactif']);

        return back()->route('Agence.Bus.index')->with('success', 'Bus désactivé avec succès');
    }
}