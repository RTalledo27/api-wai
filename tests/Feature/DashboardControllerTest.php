<?php

namespace Tests\Feature;

use App\Models\Clientes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cotizaciones;
use App\Models\Elementos;
use App\Models\Elementos_cotizacion;
use App\Models\Empleados;
use App\Models\Estados;
use App\Models\Proyectos;
use App\Models\Roles;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Factories\Factory;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;


  

    public function test_dashboard()
    {
        $empleado = Empleados::factory()->create();
        $this->actingAs($empleado, 'api');

        $proyecto = Proyectos::factory()->create();
        $cotizacion = Cotizaciones::factory()->create(['idProyecto' => $proyecto->idProyecto]);

        $response = $this->get('/api/v1/dashboard');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'total_proyectos',
                'proyectos_pendiente',
                'proyectos_en_curso',
                'proyectos_culminados',
                'proyectos_cancelados',
                'ingresos_proyectos_pendiente',
                'ingresos_proyectos_en_curso',
                'ingresos_proyectos_culminados',
            ]);
    }



    public function test_dashboard_index()
    {
       

        //* PCREAR PROYECTO
        $estado = Estados::factory()->create(['estado' => 'Cancelado']);
        $rol = Roles::factory()->create(['nombre_rol' => 'Desarrollador']);
        $empleado = Empleados::factory()->create([
            'idRol' => $rol->idRol,
            'nombre_empleado' => 'Gianfranco',
            'dni_empleado' => '76031710',
            'correo_empleado' => 'roma@example.com',
            'usuario' => 'Roma',
        ]);

         //*INICIAR SESION
       
         $this->actingAs($empleado, 'api');


        $cliente = Clientes::factory()->create([
            'nombre_cliente' => 'Juan',
            'correo_cliente' => 'juan@example.com',
            'telefono_cliente' => '959348541',
            'dni_cliente' => '75201144',
        ]);

        $proyecto = Proyectos::factory()->create([
            'idProyecto'=>1,
            'nombre_proyecto' => 'Proyecto Prueba',
            'descripcion' => 'Esta es una prueba',
            'fecha_inicio' => '2024-06-17',
            'fecha_fin' => '2024-06-17',
            'idEstado' => $estado->idEstado,
            'idEmpleado' => $empleado->idEmpleado,
            'idCliente' => $cliente->idCliente,
        ]);

        $cotizacion = Cotizaciones::factory()->create([
            'idEmpleado' => $empleado->idEmpleado,
            'idCliente' => $cliente->idCliente,
            'idProyecto' => $proyecto->idProyecto,  //* Ensure idProyecto is set properly
            'fecha_cotizacion' => '2024-06-17',
            'subtotal' => '200.00',
            'descuento' => '0.00',
            'total' => '200.00',
            'idEstado' => 1,
        ]);

        $elemento = Elementos::factory()->create();

        Elementos_cotizacion::factory()->create([
            'idElemento' => $elemento->idElemento,
            'idCotizacion' => $cotizacion->idCotizacion,
        ]);

      

        //* OBTENER RESPUESTA DE /api/v1/proyectos Y VERIFICAR SU ESTRUCTURA Y ESTADO DE RESPUESTA
        $response = $this->getJson('/api/v1/proyectos');

        //* ESTADO DE RESPUESTA Y ESTRUCTURA DE JSON
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                             'idProyecto', 
                             'nombre_proyecto', 
                             'descripcion', 
                             'fecha_inicio', 
                             'fecha_fin', 
                             'empleado' => [
                                 'idEmpleado', 
                                 'idRol', 
                                 'nombre_empleado', 
                                 'dni_empleado', 
                                 'correo_empleado', 
                                 'usuario', 
                                 'created_at', 
                                 'updated_at',
                             ], 
                             'cliente' => [
                                 'idCliente', 
                                 'nombre_cliente', 
                                 'correo_cliente', 
                                 'telefono_cliente', 
                                 'dni_cliente', 
                                 'created_at', 
                                 'updated_at',
                             ], 
                             'estado' => [
                                 'idEstado', 
                                 'estado', 
                                 'created_at', 
                                 'updated_at',
                             ], 
                             'cotizacion' => [
                                 'idCotizacion', 
                                 'idEmpleado', 
                                 'idCliente', 
                                 'idProyecto', 
                                 'fecha_cotizacion', 
                                 'subtotal', 
                                 'descuento', 
                                 'total', 
                                 'idEstado', 
                                 'created_at', 
                                 'updated_at', 
                                 'elementos_cotizacion' => [
                                     '*' => [
                                         'idElemento_cotizacion', 
                                         'idElemento', 
                                         'idCotizacion', 
                                         'created_at', 
                                         'updated_at',
                                     ]
                                 ]
                             ]
                         ]
                     ]
                 ]);


    }

    
   
}
