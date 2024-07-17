<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

     

        //\App\Models\Roles::factory(3)->create();
        //\App\Models\Proyectos::factory(1)->create();
        //\App\Models\Elementos::factory(2)->create();
        //\App\Models\Cotizaciones::factory(1)->create();
        //\App\Models\Elementos_cotizacion::factory(3)->create();
        //\App\Models\Clientes::factory(1)->create();
        \App\Models\Empleados::factory(2)->create();
        //\App\Models\Estados::factory(3)->create();


    }
}
