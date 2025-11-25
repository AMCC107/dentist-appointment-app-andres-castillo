<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

//Citas model
class Appointment extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'nombre',
        'fecha_hora',
        'doctor_id',
        'paciente_id',
        'tratamiento_id'
    ];


    protected function creates(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
