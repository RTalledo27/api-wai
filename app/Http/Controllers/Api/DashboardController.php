<?php

namespace App\Http\Controllers\Api;

use App\Models\Cotizaciones;
use Illuminate\Support\Facades\DB; 
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Roles;
use App\Models\Estados;
use App\Models\Empleados;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Hoa\Console;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;



class DashboardController extends Controller
{
    //
   
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function dashboard(Request $request)
    {
        $empleado = auth()->guard('api')->user();
        $empleado = Empleados::find($empleado->idEmpleado);
        if (!$empleado) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }else{

            //TOTAL PROYECTOS
            $total_proyectos = Proyectos::count();
            //TOTAL PROYECTOS POR ESTADO
            $proyectos_pendiente = Proyectos::where('idEstado', 1)->count();
            $proyectos_en_curso = Proyectos::where('idEstado', 2)->count();
            $proyectos_culminados = Proyectos::where('idEstado', 3)->count();
            $proyectos_cancelados = Proyectos::where('idEstado', 4)->count();


            //INGRESOS PROYECTOS POR ESTADO
            //INGRESOS PENDIENTES
            $ingresos_proyectos_pendiente = Cotizaciones::join('proyectos', 'cotizaciones.idProyecto', '=', 'proyectos.idProyecto')
            ->where('proyectos.idEstado', 1)
            ->sum('total');  
            //INGRESSOS PROYECTOS EN CURSO
            $ingresos_proyectos_en_curso = Cotizaciones::join('proyectos', 'cotizaciones.idProyecto', '=', 'proyectos.idProyecto')
            ->where('proyectos.idEstado', 2)
            ->sum('total');

            //INGRESOS GENERADOS
            $ingresos_proyectos_culminados = Cotizaciones::join('proyectos', 'cotizaciones.idProyecto', '=', 'proyectos.idProyecto')
            ->where('proyectos.idEstado', 3)
            ->sum('total');
            //INGRESOS PERDIDOS
            $ingresos_proyectos_cancelados = Cotizaciones::join('proyectos', 'cotizaciones.idProyecto', '=', 'proyectos.idProyecto')
            ->where('proyectos.idEstado', 4)
            ->sum('total');

            //LISTA DE DESARROLLADORES CON PROYECTOS CULMINADOS
            $desarolladores_proyectos_culminados =Empleados::select('empleados.nombre_empleado as desarrollador', DB::raw('COUNT(proyectos.idProyecto) as proyectos_desarrollados'))
            ->join('proyectos', 'empleados.idEmpleado', '=', 'proyectos.idEmpleado')
            ->join('estados', 'proyectos.idEstado', '=', 'estados.idEstado')
            ->where('estados.idEstado', 3)
            ->groupBy('empleados.idEmpleado', 'empleados.nombre_empleado')
            ->orderByDesc('proyectos_desarrollados')
            ->get();
            
        return response()->json([
            'message' => 'Acceso permitido', 
            'desarolladores_proyectos_culminados' => $desarolladores_proyectos_culminados,
            'total_proyectos' => $total_proyectos,
            'proyectos_pendiente' => $proyectos_pendiente,
            'proyectos_en_curso' => $proyectos_en_curso,
            'proyectos_culminados' => $proyectos_culminados,
            'proyectos_cancelados' => $proyectos_cancelados,
            'ingresos_proyectos_pendiente' => $ingresos_proyectos_pendiente,
            'ingresos_proyectos_en_curso' => $ingresos_proyectos_en_curso,
            'ingresos_proyectos_culminados' => $ingresos_proyectos_culminados,
            'ingresos_proyectos_cancelados' => $ingresos_proyectos_cancelados
            
        ]);
        }

    }



    public function index(){
        $proyectos = DB::table('proyectos')
        -> select('*')
        ->join('estados', 'proyectos.idEstado', '=', 'estados.idEstado')
        ->join('empleados', 'proyectos.idEmpleado', '=', 'empleados.idEmpleado')
        ->join('clientes', 'proyectos.idCliente', '=', 'clientes.idCliente')
        ->get();
        ;
        return response()->json($proyectos);
    }

}
