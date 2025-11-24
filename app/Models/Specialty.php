<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relación: Una especialidad tiene muchos doctores.
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Relación: Una especialidad tiene muchas citas.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}