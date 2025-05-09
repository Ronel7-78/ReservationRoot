<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAgenceRequest;
use App\Models\Agence;
use App\Models\Bus;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\Voyage;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agence = auth()->user()->agence;
        $agenceId = $agence->id;

        // Compter les bus
        $totalBuses = Bus::where('agence_id', $agenceId)->count();
        $availableBuses = Bus::where('agence_id', $agenceId)
                            ->where('statut', 'Actif')
                            ->count();

        // Compter les trajets actifs
        $activeTrajets = Trajet::where('agence_id', $agenceId)
                        ->where('statut', 'Actif')
                        ->count();

        // Voyages confirmés
        $voyagesConfirnes = Voyage::whereHas('trajet', function ($query) use ($agenceId) {
            $query->where('agence_id', $agenceId);
        })
        ->where('created_at', '>=', now()->subDays(1))
        ->with(['trajet', 'bus'])
        ->get();
        // Nouveaux bus
        $nouveauxBuses = Bus::where('agence_id', $agenceId)
                    ->where('created_at', '>=', now()->subDays(1))
                    ->get();

        // Réservations annulées
        $reservationsAnnulees = Reservation::where('agence_id', $agenceId)
                                ->where('statut', 'Annulé')
                                ->whereMonth('created_at', now()->month)
                                ->count();

        // Réservations du mois
        $reservationsCount = Reservation::where('agence_id', $agenceId)
                            ->whereMonth('created_at', now()->month)
                            ->count();

        // Revenus du mois
        //$revenus = Reservation::where('agence_id', $agenceId)
        //        ->whereMonth('created_at', now()->month)
        //        ->join('trajets', 'reservations.trajet_id', '=', 'trajets.id') // Assurez-vous que 'trajet_id' existe dans 'reservations'
        //        ->sum('trajets.prix'); // Utilisez 'trajets.prix' pour accéder à la colonne prix

        return view('Users.Agences.dashboard', compact(
            'totalBuses',
            'availableBuses',
            'activeTrajets',
            'voyagesConfirnes',
            'nouveauxBuses',
            'reservationsAnnulees',
            'reservationsCount',
            
            'agence'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgenceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Agence $agence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agence $agence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgenceRequest $request, Agence $agence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agence $agence)
    {
        //
    }
}
