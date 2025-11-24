<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id',
        'professional_license',
        'consulting_room',
    ];

    /**
     * Relación: Un Doctor "pertenece" a un Usuario (para Nombre, Email, Pass).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un Doctor tiene una Especialidad.
     */
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
    
    // Relación con Citas (Appointments) - Para verificar antes de borrar
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}