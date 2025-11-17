<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

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
        // Lógica de actualización
    }

    public function destroy(Patient $patient)
    {
        // Lógica de eliminación
    }
}