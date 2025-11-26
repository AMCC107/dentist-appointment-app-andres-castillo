<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

//Citas model
class Appointment extends Authenticatable
{
    use HasFactory, HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'fecha_hora',
        'doctor_id',
        'paciente_id',
        'tratamiento_id'
    ];

    // Relations
    public function paciente()
    {
        return $this->belongsTo(Patients::class, 'paciente_id');
    }

    public function tratamiento()
    {
        return $this->belongsTo(Treatment::class, 'tratamiento_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')
            ->whereHas('roles', function ($query) {
                $query->where('id', 2);
            });
    }

}
