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

    // ReservationController.php
    //public function getSieges(Voyage $voyage)
    //{
    //    try {
    //        $voyage->load(['bus.sieges.reservations']);
    //
    //        $sieges = $voyage->bus->sieges->map(function ($siege) use ($voyage) {
    //            return [
    //                'numero' => $siege->numero,
    //                'disponible' => $siege->isDisponiblePourVoyage($voyage)
    //            ];
    //        });
//
    //        return response()->json([
    //            'status' => 'success',
    //            'sieges' => $sieges,
    //            'nombre_places' => $voyage->bus->nombre_place,
    //            'tarif' => $voyage->tarif
    //        ]);
//
     //   } catch (\Exception $e) {
    //        return response()->json([
    //            'status' => 'error',
    //            'message' => 'Erreur de chargement des sièges'
    //        ], 500);
    //    }
    //}



    public function store(StoreReservationRequest $request)
{
    $voyage = Voyage::with('bus.agence')->findOrFail($request->voyage_id);
    $agence = $voyage->bus->agence;

    $reservation = new Reservation();
    $reservation->code = Reservation::generateCode($agence);
    $reservation->agence_id = $agence->id;
    $reservation->voyage_id = $request->voyage_id;
    $reservation->numero_siege = $request->numero_siege;
    $reservation->client_id = auth()->user()->client->id;

    $reservation->save();


    return redirect()->route('Client.home')->with('success', 'Réservation créée avec succès');
}






}
