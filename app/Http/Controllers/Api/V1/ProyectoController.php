<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Proyectos;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\V1\ProyectoResource;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;

class ProyectoController extends Controller
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
        $proyectos = Proyectos::with('cliente','empleado','estado','cotizacion','cotizacion.elementos_cotizacion')->get();

        return  ProyectoResource::collection($proyectos);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nombre_proyecto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'idCliente' => 'required|exists:clientes,idCliente',
            'idEstado' => 'required|exists:estados,idEstado',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'idEmpleado' => [
                'required',
                'exists:empleados,idEmpleado',
                Rule::unique('proyectos', 'idEmpleado')
                    ->where(function ($query) {
                        // Si el idEstado es diferente de 3 o 4, entonces es único
                    $query->where('proyectos.idEstado', '!=', '3')
                    ->Where('proyectos.idEstado', '!=', '4');
                    }),
            ],
        ]);    

        $proyecto = Proyectos::create($validatedData);
        
        if($empleado = json_decode($request->empleado) && $cliente = json_decode($request->cliente && $estado = json_decode($request->estado))){
            $proyecto->empleado()->attach($empleado);
            $proyecto->cliente()->attach($cliente);
            $proyecto->estado()->attach($estado);

        }


        return response()->json(new ProyectoResource($proyecto->load('cliente','empleado','estado')), Response::HTTP_CREATED); //201
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyectos $proyecto)
    {
        //
        $proyecto =  $proyecto->load('cliente','empleado','estado','cotizacion','cotizacion.elementos_cotizacion');
        return new ProyectoResource($proyecto);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyectos $proyecto)
    {
        //
        $proyecto->update($request->all());
        if($empleado = json_decode($request->empleado) ){
            $proyecto->empleado()->associate($empleado);
            if( $cliente = json_decode($request->cliente)){
                $proyecto->cliente()->sync($cliente);
                if($estado = json_decode($request->estado)){
                    $proyecto->estado()->sync($estado);
                    if($cotizacion = json_decode($request->cotizacion)){
                        $proyecto->cotizacion()->sync($cotizacion);
                        if($elementos_cotizacion = json_decode($request->elementos_cotizacion)){
                            $proyecto->elementos_cotizacion()->sync($elementos_cotizacion);
                        }
                    }
                }


            }
          

        }

        return response()->json(new ProyectoResource($proyecto->load('empleado','cliente','estado','cotizacion','cotizacion.elementos_cotizacion')), Response::HTTP_OK); //201

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyectos $proyectos)
    {
        //
    }
}
