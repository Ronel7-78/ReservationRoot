<?php

// app/Http/Controllers/BusController.php
namespace App\Http\Controllers;

use App\Models\Bus;
use App\Http\Requests\StoreBusRequest;
use App\Models\Agence;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function create()
    {
        $agenceId = auth()->user()->agence->id;
        return view('Users/Agences/Bus.create',[
            'agences'=>Agence::where('id', $agenceId)->get()
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

    public function checkDisponibilite(Request $request)
    {
        $bus = Bus::findOrFail($request->bus_id);
        $disponible = $bus->estDisponible($request->date);

        return response()->json(['disponible' => $disponible]);
    }
}