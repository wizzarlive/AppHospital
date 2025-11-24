<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        // Cargamos las citas con sus relaciones para evitar consultas N+1
        // Ordenamos por fecha descendente (las más nuevas primero)
        $appointments = Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        // Cargamos las listas para los Selects del Modal
        $patients = Patient::where('is_active', true)->orderBy('last_name')->get();
        $doctors = Doctor::with('user')->get();
        $specialties = Specialty::all();

        return view('appointments.index', compact('appointments', 'patients', 'doctors', 'specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'doctor_id'        => 'required|exists:doctors,id',
            'specialty_id'     => 'required|exists:specialties,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'status'           => 'required|in:scheduled,confirmed,completed,canceled',
            'observation'      => 'nullable|string|max:255',
        ]);

        // Validación extra: Verificar si el doctor ya tiene cita a esa hora
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', '!=', 'canceled') // Ignoramos las canceladas
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'El doctor ya tiene una cita programada en esta fecha y hora.'])->withInput();
        }

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Cita agendada exitosamente.');
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'doctor_id'        => 'required|exists:doctors,id',
            'specialty_id'     => 'required|exists:specialties,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status'           => 'required|in:scheduled,confirmed,completed,canceled',
            'observation'      => 'nullable|string|max:255',
        ]);

        // Validación de disponibilidad (ignorando la cita actual que estamos editando)
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', '!=', 'canceled')
            ->where('id', '!=', $appointment->id) // <--- IMPORTANTE
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'El horario no está disponible.'])->withInput();
        }

        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Cita actualizada correctamente.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Cita eliminada.');
    }
}