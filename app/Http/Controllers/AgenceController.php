<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgenceRequest;
use App\Http\Requests\UpdateAgenceRequest;
use App\Models\Agence;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Users.Agences.dashboard');
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
