<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey='idRol';

    public $timestamps = true;

    protected $fillable = [
        'nombre_rol',
    ];

    public function empleados(){
        return $this->hasMany(Empleados::class, 'idRol');
   }

}
