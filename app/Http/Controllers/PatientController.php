<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index()
    {
        // Ordenamos por los últimos creados
        $patients = Patient::orderBy('created_at', 'desc')->get();
        return view('patients.index', compact('patients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'dni'        => 'nullable|string|max:20|unique:patients,dni',
            'phone'      => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:150|unique:patients,email',
            'birth_date' => 'nullable|date',
            'address'    => 'nullable|string|max:255',
        ]);

        // Por defecto is_active será true desde la base de datos o modelo
        Patient::create($validatedData);

        return redirect()->route('patients.index')
            ->with('success', 'Paciente registrado exitosamente.');
    }

    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            // Validación única ignorando el ID actual del paciente
            'dni' => [
                'nullable', 'string', 'max:20',
                Rule::unique('patients')->ignore($patient->id),
            ],
            'email' => [
                'nullable', 'email', 'max:150',
                Rule::unique('patients')->ignore($patient->id),
            ],
            'phone'      => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address'    => 'nullable|string|max:255',
        ]);

        $patient->update($validatedData);

        return redirect()->route('patients.index')
            ->with('success', 'Datos del paciente actualizados correctamente.');
    }

    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();
            return redirect()->route('patients.index')
                ->with('success', 'El paciente ha sido eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('patients.index')
                ->withErrors('No se puede eliminar el paciente porque tiene citas o historiales asociados.');
        }
    }
}