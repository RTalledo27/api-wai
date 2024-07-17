<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Empleados;
use Illuminate\Http\Request;
use App\Http\Resources\V1\EmpleadoResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class EmpleadoController
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empleados = Empleados::where('isActive', 1)->get();
        return EmpleadoResource::collection($empleados);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Definir las reglas de validación
        $rules = [
            'nombre_empleado' => 'required|string|max:255',
            'dni_empleado' => 'required|numeric|unique:empleados,dni_empleado',
            'correo_empleado' => 'required|email',
            'contraseña' => 'required|string',
            'usuario' => 'required|string',
            'idRol' => 'required|numeric|exists:roles,idRol',
            'isActive' => 'required'
        ];

        // Validar el request con sus reglas
        $validator = Validator::make($request->all(), $rules);

        // Manejar los errores de validación
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Hashear la contraseña antes de guardar
        $validatedData = $validator->validated();
        $validatedData['contraseña'] = Hash::make($request->contraseña);

        // Crear el empleado
        $empleado = Empleados::create($validatedData);

        // Devolver la respuesta exitosa
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
        //OBENER EMPLEADO ID
        
        //* Validar que el 'dni' sea único, excluyendo el 'empleado' actual
        $validator = Validator::make($request->all(), [
            'dni_empleado' => [
                'required',
                'numeric',
                Rule::unique('empleados', 'dni_empleado')->ignore($empleado->idEmpleado, 'idEmpleado')  
            ] ,
        ]);

        // Si la validación falla, devolver una respuesta de error
        if ($validator->fails()) {
            return response()->json([
                'error' => 'El dni ya se encuentra registrado.'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // Si la validación pasa, actualizar el 'empleado'
        $empleado->update($request->all());

        return response()->json(new EmpleadoResource($empleado), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleados $empleado)
    {
        //
        $empleado->update(['isActive' => 0]);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
