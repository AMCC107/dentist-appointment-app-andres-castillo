<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // <-- corregido

class Patients extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'fecha_nacimiento',
        'phone',
        'address',
        'doctor_id',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

}
