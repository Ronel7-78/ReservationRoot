<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Siege;
use App\Models\Voyage;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = auth()->user();
        $voyages = Voyage::with(['bus.sieges', 'trajet'])
            ->whereHas('bus', fn($q) => $q->where('agence_id', $client->agence_id))
            ->where('date_depart', '>', now())
            ->get();

        return view('Users/Clients.Reservation', compact('voyages', 'client'));
    }

    public function store(StoreReservationRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $client = auth()->user();
            $siege = Siege::where('bus_id', $request->voyage->bus_id)
                ->where('numero', $request->numero_siege)
                ->lockForUpdate()
                ->firstOrFail();

            if (!$siege->disponible) {
                return back()->withErrors(['numero_siege' => 'Siège déjà réservé']);
            }

            $reservation = Reservation::create([
                'agence_id' => $client->agence_id,
                'voyage_id' => $request->voyage_id,
                'numero_siege' => $request->numero_siege
            ]);

            $siege->update(['disponible' => false]);

            return redirect()->route('reservations.show', $reservation);
        });
    }

    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
