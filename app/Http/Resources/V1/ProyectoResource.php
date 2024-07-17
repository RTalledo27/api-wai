<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idProyecto'=> $this->idProyecto, // Corrected field name
            'nombre_proyecto' => $this->nombre_proyecto, // Corrected field name
            'descripcion' => $this->descripcion,
            'fecha_inicio' => $this->fecha_inicio, // Corrected field name
            'fecha_fin' => $this->fecha_fin, // Corrected field name
            'empleado' =>$this->empleado, // Corrected field name
            'cliente' => $this->cliente,
            'estado' => $this->estado,
            'cotizacion'=>$this->cotizacion,
            //'elementos_cotizacion'=>$this->elemento_cotizacion,
            
        ];
    }


}
