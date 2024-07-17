<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Elementos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\ElementoResource;

class ElementoController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $elementos = Elementos::where('isActive', 1)->get();
        return ElementoResource::collection($elementos);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nombre_elemento' => 'required',
            'descripcion' => 'required',
            'costo' => 'required',
            'isActive' => 'required'
        ]);

        $elemento = Elementos::create($validatedData);

        return new ElementoResource($elemento);

    }

    /**
     * Display the specified resource.
     */
    public function show(Elementos $elemento)
    {
        //
        return new ElementoResource($elemento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Elementos $elemento)
    {
        //
        $elemento->update($request->all());

        return response()->json(new ElementoResource($elemento  ), Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Elementos $elemento)
    {
        
        $elemento->update(['isActive' => 0]);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
