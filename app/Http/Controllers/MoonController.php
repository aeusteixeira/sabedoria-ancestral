<?php

namespace App\Http\Controllers;

use App\Models\Moon;
use App\Http\Requests\StoreMoonRequest;
use App\Http\Requests\UpdateMoonRequest;

class MoonController extends Controller
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
    public function store(StoreMoonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Moon $moon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moon $moon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMoonRequest $request, Moon $moon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moon $moon)
    {
        //
    }
}
