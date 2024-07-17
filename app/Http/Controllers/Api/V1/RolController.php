<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\RolResource;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $empleado = auth()->guard('api')->user();

        if(!$empleado){
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }else{
            return  RolResource::collection(Roles::all());
        }
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules =[
            'nombre_rol' => 'required|string|max:255',
        ];

        // Validar el request con sus reglas
        $validator = Validator::make($request->all(), $rules);

        // Manejar los errores de validación
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Crear el rol
        $rol = Roles::create($request->all());

        // Devolver la respuesta exitosa
        return response()->json(new RolResource($rol), Response::HTTP_CREATED);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
