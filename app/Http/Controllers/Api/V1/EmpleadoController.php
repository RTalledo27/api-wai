<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Empleados;
use Illuminate\Http\Request;
use App\Http\Resources\V1\EmpleadoResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Hash;

class EmpleadoController
{

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        return EmpleadoResource::collection(Empleados::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
        'nombre_empleado' => 'required|string|max:255',
        'dni_empleado' => 'required|numeric|unique:empleados,dni_empleado',
        'correo_empleado'=> 'required|email',
        'contraseña' => 'required|string',
        'usuario' => 'required|string',
        'idRol' => 'required|numeric|exists:roles,idRol'

        ]);
        $validatedData['contraseña'] = Hash::make($request->contraseña);

        $empleado = Empleados::create($validatedData);

        return response()->json(new EmpleadoResource($empleado), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleados $empleado)
    {
        //
        return new EmpleadoResource($empleado);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleados $empleado)
    {
        //
        $empleado->update($request->all());

        return response()->json(new EmpleadoResource($empleado), Response::HTTP_OK);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleados $empleados)
    {
        //
    }
}
