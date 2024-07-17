<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\LoginController;
use App\Models\Empleados;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;


    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_login_complete(){
        $empleado = Empleados::factory()->create();

        //CREAR EMPLEADO Y REALIZAR LOGUEO
        $response = $this->post('/api/auth/login', [
            'correo_empleado' => $empleado->correo_empleado,
            'password' => 'password'
        ]);


        //dd( $response->json());

        $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    public function test_login_with_credentials_incorrects(){
        //SOLICITUD A LOGIN CON DATOS INCORRECTOS
        $response = $this->post('/api/auth/login', [
            'correo_empleado' => 'example@example.com',
            'password' => 'password'
        ]);

        //VERIFICAR ESTADO Y MENSAJE DE ERROR
        $response->assertStatus(401)
        ->assertJson([
            'error' => 'Email o Contraseña incorrectos'
        ]);

        $this->assertGuest('api');  

    }


    public function test_get_data_login_complete(){
      
      //CREAR EMPLEADO Y REALIZAR LOGUEO
      $empleado = Empleados::factory()->create();

      $response = $this->post('/api/auth/login', [
           'correo_empleado' => $empleado->correo_empleado,
           'password' => 'password'
      ]);

      //OBTENER RESPUESTA DE /api/auth/me Y VERIFICAR SU ESTRUCTURA Y ESTADO DE RESPUESTA
         $response = $this->get('/api/auth/me');

         //dd($response->json());

         $response->assertStatus(200)
         ->assertJsonStructure([
             'idEmpleado',
             'idRol',
             'nombre_empleado',
             'dni_empleado',
             'correo_empleado',
             'usuario',
             'created_at',
             'updated_at'
         ]);

        
    
   
  
    }


}
