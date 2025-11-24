<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    public function index()
    {
        // Traemos al doctor junto con su usuario y especialidad (Eager Loading)
        $doctors = Doctor::with(['user', 'specialty'])->get();
        
        // Necesitamos las especialidades para el Select del Modal
        $specialties = Specialty::all();

        return view('doctors.index', compact('doctors', 'specialties'));
    }

    public function store(Request $request)
    {
        // 1. Validar todo junto
        $validated = $request->validate([
            // Datos de Usuario
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            // Datos de Doctor
            'specialty_id'         => 'required|exists:specialties,id',
            'professional_license' => 'required|string|max:50|unique:doctors',
            'consulting_room'      => 'nullable|string|max:100',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // A. Crear Usuario
                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                ]);

                // B. Asignar Rol (Usando DB directo o relación si la tienes configurada)
                // Asumiendo que tienes la tabla role_user y el rol doctor es ID 2
                DB::table('role_user')->insert([
                    'user_id' => $user->id,
                    'role_id' => 2 // ID del rol Doctor
                ]);

                // C. Crear Perfil Doctor
                Doctor::create([
                    'user_id'              => $user->id,
                    'specialty_id'         => $validated['specialty_id'],
                    'professional_license' => $validated['professional_license'],
                    'consulting_room'      => $validated['consulting_room'],
                ]);
            });

            return redirect()->route('doctors.index')->with('success', 'Doctor registrado correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al registrar: ' . $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, Doctor $doctor)
    {
        // Validar
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($doctor->user_id)],
            'specialty_id'         => 'required|exists:specialties,id',
            'professional_license' => ['required', Rule::unique('doctors')->ignore($doctor->id)],
            'consulting_room'      => 'nullable|string|max:100',
        ]);

        try {
            DB::transaction(function () use ($validated, $doctor) {
                // A. Actualizar Usuario
                $doctor->user->update([
                    'name'  => $validated['name'],
                    'email' => $validated['email'],
                ]);

                // B. Actualizar Doctor
                $doctor->update([
                    'specialty_id'         => $validated['specialty_id'],
                    'professional_license' => $validated['professional_license'],
                    'consulting_room'      => $validated['consulting_room'],
                ]);
            });

            return redirect()->route('doctors.index')->with('success', 'Datos del doctor actualizados.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Doctor $doctor)
    {
        // Verificar si tiene citas antes de borrar (Opcional pero recomendado)
        if($doctor->appointments()->exists()){
            return back()->withErrors('No se puede eliminar al doctor porque tiene citas asociadas.');
        }

        try {
            // Al borrar el usuario, la cascada (onDelete cascade) de la migración borrará al doctor
            $doctor->user->delete(); 
            
            return redirect()->route('doctors.index')->with('success', 'Doctor eliminado del sistema.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar: ' . $e->getMessage());
        }
    }
}