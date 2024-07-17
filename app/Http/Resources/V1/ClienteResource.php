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
                'nombre' => $this->nombre_cliente,
                'dni' => $this->dni_cliente,
                'email' => $this->correo_cliente,
                'telefono' => $this->telefono_cliente,
            ]
        ];
    }
}
