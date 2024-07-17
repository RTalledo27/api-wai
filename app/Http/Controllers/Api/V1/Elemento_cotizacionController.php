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
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'idCotizacion' => 'required|exists:cotizaciones,idCotizacion',
                'idElemento' => 'required|exists:elementos,idElemento'
            ]);
        
            // Buscar si ya existe un elemento de cotización con los mismos idCotizacion e idElemento
            $existe = Elementos_cotizacion::where('idCotizacion', $validatedData['idCotizacion'])
                                          ->where('idElemento', $validatedData['idElemento'])
                                          ->exists();
        
            // Si ya existe, devolver un mensaje indicando que el elemento ya está asociado a la cotización
            if ($existe) {
                return response()->json(['message' => 'El elemento ya está asociado a la cotización'], Response::HTTP_CONFLICT);
            }
        
            // Si no existe, crear el nuevo elemento de cotización
            $elementos_cotizacion = Elementos_cotizacion::create($validatedData);
        
            // Devolver una respuesta con el elemento de cotización creado
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
    public function destroy($idCotizacion)
    {
        //ELIMINAR ELEMENTOS
        
        try {
            // Intentar eliminar los elementos de cotización
            $cantidadEliminada = Elementos_cotizacion::where('idCotizacion', $idCotizacion)->delete();
            if ($cantidadEliminada > 0) {
                return response()->json(['message' => 'Elemento(s) de cotización eliminado(s) con éxito'], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'No se encontraron elementos de cotización para eliminar'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el elemento de cotización', $e], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
