<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ClienteResource;
use Illuminate\Http\Response;

class ClienteController
{


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ClienteResource::collection(Clientes::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'correo_cliente'=> 'required|email',
            'telefono_cliente' =>'required|numeric',
            'dni_cliente' => 'required|numeric',

        ]);

        $cliente = Clientes::create($validatedData);

       

        return response()->json(new clienteResource($cliente), Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $cliente)
    {
        //
        return new ClienteResource($cliente);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $cliente)
    {
        //
        $validatedData = $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'correo_cliente'=> 'required|email',
            'telefono_cliente' =>'required|numeric',
            'dni_cliente' => 'required|numeric',

        ]);

        $cliente->update($validatedData);

        return response()->json(new ClienteResource($cliente), Response::HTTP_OK);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
