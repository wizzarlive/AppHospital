<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view(view: 'patients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dni' => 'nullable|string|max:20|unique:patients,dni',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:150|unique:patients,email',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);
        
        Patient::create($validatedData);

        return redirect()->route('patients.index')->with('success', 'Paciente registrado exitosamente.');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

public function update(Request $request, Patient $patient)
    {
        // 1. Validar los datos de entrada
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            
            // DNI debe ser único, ignorando el DNI del paciente actual
            'dni' => [
                'nullable', 
                'string', 
                'max:20', 
                Rule::unique('patients')->ignore($patient->id),
            ],
            
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:50',
            
            // Email debe ser único, ignorando el email del paciente actual
            'email' => [
                'nullable', 
                'email', 
                'max:255', 
                Rule::unique('patients')->ignore($patient->id),
            ],
            
            'address' => 'nullable|string|max:500',
        ]);
        
        try {
            // 2. Actualizar el registro del paciente
            $patient->update($validatedData);

            // 3. Redirigir con mensaje de éxito
            return redirect()
                ->route('patients.index')
                ->with('success', "Los datos del paciente {$patient->first_name} {$patient->last_name} han sido actualizados exitosamente.");

        } catch (\Exception $e) {
            // 4. Manejar errores
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['update_error' => 'Ocurrió un error al intentar actualizar el paciente.']);
        }
    }

    public function destroy(Patient $patient)
    {
        // Lógica de eliminación
    }
}