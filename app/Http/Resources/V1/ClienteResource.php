<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'idCliente' => $this->idCliente,
            'type'=>'cliente',
            'attributes'=>[
                'nombre_cliente' => $this->nombre_cliente,
                'dni_cliente' => $this->dni_cliente,
                'correo_cliente' => $this->correo_cliente,
                'telefono_cliente' => $this->telefono_cliente,
                
            ]
        ];
    }
}
