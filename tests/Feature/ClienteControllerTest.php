<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clientes;
use App\Models\Empleados;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
   
   
   
   
     public function test_index()
     {
         //simular autenticacion
       
 
         $empleado = Empleados::factory()->create();
 
         //CREAR EMPLEADO Y REALIZAR LOGUEO
         $response = $this->post('/api/auth/login', [
             'correo_empleado' => $empleado->correo_empleado,
             'password' => 'password'
         ]);
 
         $clientes = Clientes::factory()->count(3)->create();
 
         $response = $this->get('/api/v1/clientes');
 
         
         $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     '*' => [
                         'idCliente',
                         'type',
                         'attributes' => [
                             'nombre',
                             'dni',
                             'email',
                             'telefono',
                         ],
                         'created_at',
                         'updated_at',
                     ],
                 ],
             ]);
     }
 
     /**
      * Test the store method.
      *
      * @return void
      */
     public function test_store()
     {
         $data = [
             'nombre_cliente' => $this->faker->name,
             'correo_cliente' => $this->faker->unique()->safeEmail,
             'telefono_cliente' => $this->faker->phoneNumber,
             'dni_cliente' => $this->faker->randomNumber(8),
         ];
 
         $response = $this->post('/api/v1/clientes', $data);
 
         $response->assertStatus(201)
             ->assertJsonStructure([
                 'data' => [
                     'idCliente',
                     'type',
                     'attributes' => [
                         'nombre',
                         'dni',
                         'email',
                         'telefono',
                     ],
                     'created_at',
                     'updated_at',
                 ],
             ]);
 
         $this->assertDatabaseHas('clientes', $data);
     }
 
     /**
      * Test the show method.
      *
      * @return void
      */
     public function test_show()
     {
         $cliente = Clientes::factory()->create();
 
         $response = $this->get("/api/v1/clientes/{$cliente->idCliente}");
 
         $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                    'idCliente',
                     'type',
                     'attributes' => [
                         'nombre',
                         'dni',
                         'email',
                         'telefono',
                     ],
                     'created_at',
                     'updated_at',
                 ],
             ]);
     }
 
     /**
      * Test the update method.
      *
      * @return void
      */
     public function test_update()
     {
         $cliente = Clientes::factory()->create();
 
         $data = [
             'nombre_cliente' => $this->faker->name,
             'correo_cliente' => $this->faker->unique()->safeEmail,
             'telefono_cliente' => $this->faker->phoneNumber,
             'dni_cliente' => $this->faker->randomNumber(8),
         ];
 
         $response = $this->put("/api/v1/clientes/{$cliente->id}", $data);
 
         $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     'idCliente',
                     'type',
                     'attributes' => [
                         'nombre',
                         'dni',
                         'email',
                         'telefono',
                     ],
                     'created_at',
                     'updated_at',
                 ],
             ]);
 
         $this->assertDatabaseHas('clientes', $data);
     }
   
   
   
}
