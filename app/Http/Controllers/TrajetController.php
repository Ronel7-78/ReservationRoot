<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrajetRequest;
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
        Trajet::create($request->validated());
         
        return redirect()->route('Agence.dashboard')
            ->with('success', 'Trajet créé avec succès!');
    }
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
