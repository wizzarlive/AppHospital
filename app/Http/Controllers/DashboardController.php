<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon; // Para manejar fechas

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. OBTENER ESTADÍSTICAS (Usando tus modelos actuales) ---

        // Contar citas con estado 'scheduled' (programada)
        $pendingAppointments = Appointment::where('status', 'scheduled')->count();
        
        // Contar pacientes creados este mes
        $newPatients = Patient::whereMonth('created_at', Carbon::now()->month)
                              ->whereYear('created_at', Carbon::now()->year)
                              ->count();
        
        // Contar total de doctores
        $activeDoctors = Doctor::count();

        // Contar citas canceladas hoy
        $canceledToday = Appointment::where('status', 'canceled')
                                    ->whereDate('updated_at', Carbon::today())
                                    ->count();

        // --- 2. LISTA DE PRÓXIMAS CITAS ---
        // Usamos las relaciones que ya tienes en tu modelo Appointment: patient, doctor, specialty
        $upcomingAppointments = Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->whereDate('appointment_date', '>=', Carbon::today()) // Desde hoy
            ->where('status', 'scheduled') // Solo las programadas
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->take(5) // Solo las 5 primeras
            ->get();

        // --- 3. ENVIAR DATOS A LA VISTA ---
        return view('dashboard', compact(
            'pendingAppointments', 
            'newPatients', 
            'activeDoctors', 
            'canceledToday',
            'upcomingAppointments'
        ));
    }
}