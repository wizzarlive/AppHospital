<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty; // Importante: No olvides importar este modelo
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. TARJETAS DE TOTALES (KPIs) ---
        // Usamos count() para obtener el número total de registros en cada tabla
        $totalDoctors       = Doctor::count();
        $totalAppointments  = Appointment::count();
        $totalPatients      = Patient::count();
        $totalSpecialties   = Specialty::count();

        // --- 2. DATOS PARA LOS MODALES (Selects) ---
        // Estas consultas son obligatorias para llenar los formularios emergentes
        
        // Pacientes activos ordenados por apellido
        $patients    = Patient::where('is_active', true)->orderBy('last_name')->get();
        
        // Doctores con su usuario asociado (para mostrar el nombre)
        $doctors     = Doctor::with('user')->get();
        
        // Especialidades ordenadas alfabéticamente
        $specialties = Specialty::orderBy('name')->get();

        // Enviamos todas las variables a la vista usando compact()
        return view('dashboard', compact(
            // Variables para las Tarjetas
            'totalDoctors',
            'totalAppointments',
            'totalPatients',
            'totalSpecialties',
            
            // Variables para los Modales
            'patients',
            'doctors',
            'specialties'
        ));
    }
}