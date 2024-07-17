<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Elementos_cotizacion;
use Illuminate\Http\Request;
use App\Http\Resources\V1\Elemento_cotizacionResource;
use Illuminate\Http\Response;

class Elemento_cotizacionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $elementos_cotizacion = Elementos_cotizacion::with('cotizacion','elemento')->get();
        return Elemento_cotizacionResource::collection($elementos_cotizacion);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'idCotizacion' => 'required|exists:cotizaciones,idCotizacion',
            'idElemento' => 'required|exists:elementos,idElemento'
        ]);

        $elementos_cotizacion = Elementos_cotizacion::create($validatedData);
     return response()->json(new Elemento_cotizacionResource($elementos_cotizacion), Response::HTTP_CREATED);
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Elementos_cotizacion $elementos_cotizacion)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Elementos_cotizacion $elementos_cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Elementos_cotizacion $elementos_cotizacion)
    {
        //
    }
}
