<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SpecialtyController extends Controller
{
    public function index()
    {
        // Cargamos las especialidades y contamos cuántos doctores tienen asociados
        $specialties = Specialty::withCount('doctors')->orderBy('name')->get();
        return view('specialties.index', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:specialties,name',
            'description' => 'nullable|string|max:255',
        ]);

        Specialty::create($validated);

        return redirect()->route('specialties.index')->with('success', 'Especialidad creada exitosamente.');
    }

    public function update(Request $request, Specialty $specialty)
    {
        $validated = $request->validate([
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('specialties')->ignore($specialty->id) // Ignorar el propio registro al validar único
            ],
            'description' => 'nullable|string|max:255',
        ]);

        $specialty->update($validated);

        return redirect()->route('specialties.index')->with('success', 'Especialidad actualizada.');
    }

    public function destroy(Specialty $specialty)
    {
        // Validar si hay doctores o citas usando esta especialidad antes de borrar
        if ($specialty->doctors()->exists()) {
            return back()->withErrors(['error' => 'No se puede eliminar: Hay doctores registrados con esta especialidad.']);
        }

        if ($specialty->appointments()->exists()) {
            return back()->withErrors(['error' => 'No se puede eliminar: Hay citas históricas con esta especialidad.']);
        }

        $specialty->delete();

        return redirect()->route('specialties.index')->with('success', 'Especialidad eliminada.');
    }
}