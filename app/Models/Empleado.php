<?php

namespace App\Models;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'edad',
        'sueldo_base',
        'direccion',
        'foto',
        'id_administrador',
        'id_sucursal',
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function sucursal(){
        return $this->hasOne(Sucursal::class);
    }
}
