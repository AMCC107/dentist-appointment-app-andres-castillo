<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // <-- corregido

class Treatment extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nombre',
        'duracion',
        'costo',
        'cuidados',
        'doctor_id',
    ];

}
