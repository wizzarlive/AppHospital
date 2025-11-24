<?php

namespace App\Http\Controllers;

use App\Models\ClinicalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClinicalRecordController extends Controller
{
    public function index()
    {
        // Listar historiales con datos relacionados
        $records = ClinicalRecord::with(['appointment.patient', 'appointment.specialty', 'doctor.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Para el Modal CREAR: Obtener solo citas que NO tienen historial todavía
        // y que no estén canceladas.
        $usedAppointmentIds = ClinicalRecord::pluck('appointment_id');
        
        $availableAppointments = Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->whereNotIn('id', $usedAppointmentIds)
            ->where('status', '!=', 'canceled')
            ->orderBy('appointment_date', 'desc')
            ->get();

        // Para el Modal EDITAR: Necesitamos la lista completa para no romper el select
        // si estamos editando un registro existente.
        $allAppointments = Appointment::with(['patient', 'doctor.user'])->get();

        return view('clinical_records.index', compact('records', 'availableAppointments', 'allAppointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id|unique:clinical_records,appointment_id',
            'diagnosis'      => 'required|string',
            'notes'          => 'nullable|string',
            'recipes'        => 'nullable|string',
        ]);

        // Buscar la cita para obtener el doctor automáticamente
        $appointment = Appointment::findOrFail($validated['appointment_id']);

        ClinicalRecord::create([
            'appointment_id' => $appointment->id,
            'doctor_id'      => $appointment->doctor_id, // Se asigna automático según la cita
            'diagnosis'      => $validated['diagnosis'],
            'notes'          => $validated['notes'],
            'recipes'        => $validated['recipes'],
        ]);

        return redirect()->route('clinical_records.index')->with('success', 'Historial clínico registrado correctamente.');
    }

    public function update(Request $request, ClinicalRecord $clinicalRecord)
    {
        $validated = $request->validate([
            // Ignoramos el ID actual para la validación unique
            'appointment_id' => ['required', 'exists:appointments,id', Rule::unique('clinical_records')->ignore($clinicalRecord->id)],
            'diagnosis'      => 'required|string',
            'notes'          => 'nullable|string',
            'recipes'        => 'nullable|string',
        ]);

        // Si cambió la cita, actualizamos también el doctor
        $appointment = Appointment::findOrFail($validated['appointment_id']);

        $clinicalRecord->update([
            'appointment_id' => $validated['appointment_id'],
            'doctor_id'      => $appointment->doctor_id,
            'diagnosis'      => $validated['diagnosis'],
            'notes'          => $validated['notes'],
            'recipes'        => $validated['recipes'],
        ]);

        return redirect()->route('clinical_records.index')->with('success', 'Historial actualizado.');
    }

    public function destroy(ClinicalRecord $clinicalRecord)
    {
        $clinicalRecord->delete();
        return redirect()->route('clinical_records.index')->with('success', 'Registro eliminado.');
    }
}