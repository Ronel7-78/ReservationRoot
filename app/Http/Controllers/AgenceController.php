<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAgenceRequest;
use App\Models\Agence;
use App\Models\Bus;
use App\Models\Trajet;
use App\Models\Voyage;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agenceId = auth()->user()->agence->id;

        // Compter les bus
        $totalBuses = Bus::where('agence_id', $agenceId)->count();
        $availableBuses = Bus::where('agence_id', $agenceId)->where('statut', 'Actif')->count();

        // Compter les trajets actifs
        $activeTrajets = Trajet::where('agence_id', $agenceId)->where('statut', 'Actif')->count();

        // Récupérer les voyages confirmés
        $voyagesConfirnes = Voyage::where('created_at', '>=', now()->subDays(1))->get();


            // Récupérer les nouveaux bus enregistrés
        $nouveauxBuses = Bus::where('agence_id', $agenceId)
        ->where('created_at', '>=', now()->subDays(1)) // Dernieres 24 heures
        ->get();

            // Récupérer les réservations annulées
        //$reservationsAnnulees = Reservation::where('agence_id', $agenceId)
        //->where('statut', 'Annulé')
        //->whereMonth('created_at', now()->month)
        //->count();

        // Compter les réservations du mois en cours
        //$reservationsCount = Reservation::where('agence_id', $agenceId)
        //  ->whereMonth('created_at', now()->month)
          //  ->count();

        // Calculer les revenus du mois en cours
        //$revenus = Reservation::where('agence_id', $agenceId)
           // ->whereMonth('created_at', now()->month)
           // ->sum('montant'); // Supposant que 'montant' est le champ contenant le revenu

        return view('Users.Agences.dashboard', [
            'totalBuses' => $totalBuses,
            'availableBuses' => $availableBuses,
            'activeTrajets' => $activeTrajets,
            'voyagesConfirnes' => $voyagesConfirnes,
            'nouveauxBuses' => $nouveauxBuses,
        ]);
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
