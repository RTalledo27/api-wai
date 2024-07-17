<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Empleados extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens;

    protected $table = 'empleados';

    protected $primaryKey = 'idEmpleado';
    public $timestamps = true;

    protected $fillable = [
        // 'idEmpleado' is missing in the 'fillable' array
        'nombre_empleado',
        'dni_empleado',
        'correo_empleado',
        'contraseña',
        'usuario',
        'idRol',
        'isActive'
    ];

    protected $hidden = [
        'contraseña',
    ];

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'idRol');
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyectos::class, 'idEmpleado');
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }



    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
   
}
