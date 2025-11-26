<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // <-- corregido

class Treatment extends Authenticatable
{
    use HasFactory, HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'duracion',
        'costo',
        'cuidados',
        'doctor_id',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'tratamiento_id');
    }

}
