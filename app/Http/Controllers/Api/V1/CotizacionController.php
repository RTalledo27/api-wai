<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cotizaciones;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CotizacionResource;
use Illuminate\Http\Response;

class CotizacionController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cotizaciones = Cotizaciones::with('proyecto','elementos_cotizacion.elemento')->get();
        return CotizacionResource::collection($cotizaciones);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $cotizacion = Cotizaciones::create($request->all());
        

        return response()->json(new CotizacionResource($cotizacion), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show($idProyecto)
    {
        //
        $cotizaciones = Cotizaciones::with('proyecto', 'elementos_cotizacion.elemento')
        ->where('idProyecto', $idProyecto)
        ->get();

    return CotizacionResource::collection($cotizaciones); //

    if (!$cotizaciones) {
        return response()->json(['error' => 'Cotizacion no encontrada'], 404);
    }

    return new CotizacionResource($cotizaciones);
   

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cotizaciones $cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizaciones $cotizaciones)
    {
        //
    }
}
