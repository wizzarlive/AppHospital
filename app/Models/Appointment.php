<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'specialty_id',
        'appointment_date',
        'appointment_time',
        'status',          // 'scheduled', 'confirmed', 'completed', 'canceled'
        'cancellation_reason',
        'observation'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        // 'appointment_time' => 'datetime', // A veces conviene tratarlo como string si es solo hora
    ];

    // Relación con el Paciente (Administrativo)
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relación con el Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Relación con la Especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}