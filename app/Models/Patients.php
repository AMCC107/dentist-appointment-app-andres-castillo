<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // <-- corregido

class Patients extends Authenticatable
{
    use HasFactory, HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'fecha_nacimiento',
        'phone',
        'address',
        'doctor_id',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'paciente_id');
    }

}
