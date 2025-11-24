<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'doctor_id',
        'notes',
        'diagnosis',
        'recipes', // En la base de datos lo llamaste 'recipes', así que lo mantenemos
    ];

    // Relación con la Cita
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // Relación con el Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}