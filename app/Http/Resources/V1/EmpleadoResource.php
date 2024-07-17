<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idEmpleado' => $this->idEmpleado,

            'type'=>'empleado',
            
                'nombre_empleado' => $this->nombre_empleado,
                'idRol' => $this->idRol,
                'dni_empleado' => $this->dni_empleado,
                'correo_empleado' => $this->correo_empleado,
                'usuario' => $this->usuario,
                'coontraseña' => $this->contraseña,
                'isActive'=> $this->isActive,
            
            
        ];
    }
}
