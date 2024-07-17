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
        $cotizacion = Cotizaciones::with('proyecto', 'elementos_cotizacion.elemento')
        ->where('idProyecto', $idProyecto)
        ->firstOrFail(); // Usamos firstOrFail para obtener un solo resultado o lanzar una excepción

    return new CotizacionResource($cotizacion); 
   

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idProyecto)
    {
        //

     
        $cotizacion = Cotizaciones::where('idProyecto',$idProyecto)->firstOrFail();

        $cotizacion->update($request->all());
    
    // Responder al cliente con la cotización actualizada
    return response()->json(new CotizacionResource($cotizacion), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizaciones $cotizaciones)
    {
        //
    }
}
