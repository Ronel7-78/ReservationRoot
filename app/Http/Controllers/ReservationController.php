<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Bus;
use App\Models\Reservation;
use App\Models\Siege;
use App\Models\Voyage;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function create(){
        $voyages = Voyage::with([
            'bus' => function($query) {
                $query->with(['agence', 'sieges']);
            },
            'trajet'
        ])
        ->where('statut', 'Actif')
        ->where('date_depart', '>=', now())
        ->orderBy('date_depart')
        ->get();

        // Debug: Vérifiez les données
        logger()->info('Voyages chargés', [
            'count' => $voyages->count(),
            'premier_voyage' => $voyages->first() ? [
                'bus_id' => $voyages->first()->bus_id,
                'agence' => $voyages->first()->bus->agence ?? null
            ] : null
        ]);

        return view('Users/Clients.Reservation', [
            'voyages' => $voyages,
            'client' => auth()->user()
        ]);
    }

    public function getSieges(Voyage $voyage)
{
    $voyage->load(['bus.sieges']);

    if (!$voyage->bus) {
        return response()->json([
            'status' => 'error',
            'message' => 'Bus non trouvé pour ce voyage.'
        ], 404);
    }

    $sieges = $voyage->bus->sieges->map(function ($siege) {
        return [
            'numero' => $siege->numero,
            'disponible' => $siege->disponible
        ];
    });

    return response()->json([
        'status' => 'success',
        'sieges' => $sieges,
        'nombre_places' => $voyage->bus->nombre_place
    ]);
}



    public function store(StoreReservationRequest $request){
    return DB::transaction(function () use ($request) {
        $client = auth()->user();
        $voyage = Voyage::findOrFail($request->voyage_id);

        $siege = Siege::where('bus_id', $voyage->bus_id)
            ->where('numero', $request->numero_siege)
            ->lockForUpdate()
            ->firstOrFail();

        if (!$siege->disponible) {
            return back()->withErrors(['numero_siege' => 'Siège déjà réservé']);
        }

        $agenceCode = $voyage->bus->agence->code_agence;
        $lastId = Reservation::max('id') + 1;
        $annee = now()->format('y');
        $codeReservation = sprintf('%s-%04d-%s', strtoupper($agenceCode), $lastId, $annee);


        Reservation::create([
            'code' => $codeReservation,
            'agence_id' => $voyage->bus->agence_id,
            'voyage_id' => $voyage->id,
            'numero_siege' => $request->numero_siege
        ]);

        $siege->update(['disponible' => false]);

        return redirect()->route('reservations.show');
    });
}



}
