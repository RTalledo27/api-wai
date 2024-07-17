<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;
    protected $table = 'estados';

    protected $primaryKey='idEstado';

    public $timestamps = true; 

    protected $fillable = [
        'estado',
    ];


    public function proyectos()
    {
        return $this->hasMany(Proyectos::class, 'idEstado'); 
    }   
}
