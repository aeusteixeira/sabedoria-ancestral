<?php

namespace App\Http\Controllers;

use App\Models\Stone;
use App\Http\Requests\StoreStoneRequest;
use App\Http\Requests\UpdateStoneRequest;

class StoneController extends Controller
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
    public function store(StoreStoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stone $stone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stone $stone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoneRequest $request, Stone $stone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stone $stone)
    {
        //
    }
}
