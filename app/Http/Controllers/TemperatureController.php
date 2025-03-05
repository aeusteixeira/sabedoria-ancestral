<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Http\Requests\StoreTemperatureRequest;
use App\Http\Requests\UpdateTemperatureRequest;

class TemperatureController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTemperatureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Temperature $temperature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Temperature $temperature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTemperatureRequest $request, Temperature $temperature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Temperature $temperature)
    {
        //
    }
}
