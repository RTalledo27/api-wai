<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Estados;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\EstadoResource;


class EstadoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return EstadoResource::collection(Estados::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Estados $estados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estados $estados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estados $estados)
    {
        //
    }
}
