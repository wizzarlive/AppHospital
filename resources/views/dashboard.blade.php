@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel General')

@section('content')
    {{-- 
       LÓGICA ALPINE PARA GESTIONAR MÚLTIPLES MODALES 
       currentModal: controla qué ventana emergente se muestra (null, 'patient', 'doctor', 'appointment')
    --}}
    <div x-data="{ 
        currentModal: null,
        closeModal() { this.currentModal = null; }
    }" class="space-y-8 pb-24">
        
        {{-- SECCIÓN 1: TARJETAS DE TOTALES (KPIs) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Total Doctores --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-blue-600 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Doctores</p>
                <div class="flex items-center justify-between mt-3">
                    {{-- Variable desde el controlador --}}
                    <div class="text-4xl font-extrabold text-blue-700">{{ $totalDoctors ?? '0' }}</div>
                    <div class="text-blue-600 bg-blue-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total Citas --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-indigo-600 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Citas</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-indigo-700">{{ $totalAppointments ?? '0' }}</div>
                    <div class="text-indigo-600 bg-indigo-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total Pacientes --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-green-500 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pacientes</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-green-600">{{ $totalPatients ?? '0' }}</div>
                    <div class="text-green-600 bg-green-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Total Especialidades --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-purple-500 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Especialidades</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-purple-600">{{ $totalSpecialties ?? '0' }}</div>
                    <div class="text-purple-600 bg-purple-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- SECCIÓN 2: ACCIONES RÁPIDAS (Abren Modales) --}}
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span>🚀</span> Accesos Directos
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Botón Nueva Cita --}}
                <button @click="currentModal = 'appointment'" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-indigo-500 hover:shadow-lg transition-all group text-left">
                    <div class="bg-indigo-50 w-12 h-12 rounded-xl flex items-center justify-center text-indigo-600 mb-4 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Nueva Cita</h4>
                    <p class="text-sm text-gray-500 mt-1">Agendar una consulta médica rápidamente.</p>
                </button>

                {{-- Botón Registrar Paciente --}}
                <button @click="currentModal = 'patient'" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-green-500 hover:shadow-lg transition-all group text-left">
                    <div class="bg-green-50 w-12 h-12 rounded-xl flex items-center justify-center text-green-600 mb-4 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Registrar Paciente</h4>
                    <p class="text-sm text-gray-500 mt-1">Dar de alta un nuevo paciente en el sistema.</p>
                </button>

                {{-- Botón Registrar Doctor --}}
                <button @click="currentModal = 'doctor'" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all group text-left">
                    <div class="bg-blue-50 w-12 h-12 rounded-xl flex items-center justify-center text-blue-600 mb-4 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <h4 class="text-lg font-bold text-gray-900">Registrar Doctor</h4>
                    <p class="text-sm text-gray-500 mt-1">Añadir un nuevo especialista médico.</p>
                </button>

            </div>
        </div>

        {{-- 
            =========================================================================
            ZONA DE MODALES (Controlados por Alpine 'currentModal')
            =========================================================================
        --}}

        {{-- 1. MODAL NUEVA CITA --}}
        <div x-cloak x-show="currentModal === 'appointment'" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Agendar Nueva Cita</h3>
                        <button @click="closeModal()" class="text-indigo-100 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    
                    <form action="{{ route('appointments.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label class="text-xs font-bold text-gray-500 uppercase">Paciente</label>
                                <select name="patient_id" required class="w-full mt-1 rounded-lg border-gray-300">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    {{-- Lista de pacientes enviada desde el controlador --}}
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->dni }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Especialidad</label>
                                <select name="specialty_id" required class="w-full mt-1 rounded-lg border-gray-300">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    {{-- Lista de especialidades --}}
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Doctor</label>
                                <select name="doctor_id" required class="w-full mt-1 rounded-lg border-gray-300">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    {{-- Lista de doctores --}}
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Fecha</label>
                                <input type="date" name="appointment_date" required class="w-full mt-1 rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Hora</label>
                                <input type="time" name="appointment_time" required class="w-full mt-1 rounded-lg border-gray-300">
                            </div>
                            <input type="hidden" name="status" value="scheduled">
                            <div class="col-span-2">
                                <label class="text-xs font-bold text-gray-500 uppercase">Observación</label>
                                <textarea name="observation" rows="2" class="w-full mt-1 rounded-lg border-gray-300"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-bold">Agendar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 2. MODAL REGISTRAR PACIENTE --}}
        <div x-cloak x-show="currentModal === 'patient'" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-green-600 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Nuevo Paciente</h3>
                        <button @click="closeModal()" class="text-green-100 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    
                    <form action="{{ route('patients.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div><label class="text-xs font-bold">Nombre *</label><input type="text" name="first_name" required class="w-full rounded-lg border-gray-300"></div>
                            <div><label class="text-xs font-bold">Apellido *</label><input type="text" name="last_name" required class="w-full rounded-lg border-gray-300"></div>
                            <div><label class="text-xs font-bold">DNI</label><input type="text" name="dni" class="w-full rounded-lg border-gray-300"></div>
                            <div><label class="text-xs font-bold">Fecha Nac.</label><input type="date" name="birth_date" class="w-full rounded-lg border-gray-300"></div>
                            <div><label class="text-xs font-bold">Teléfono</label><input type="tel" name="phone" class="w-full rounded-lg border-gray-300"></div>
                            <div><label class="text-xs font-bold">Email</label><input type="email" name="email" class="w-full rounded-lg border-gray-300"></div>
                        </div>
                        <div><label class="text-xs font-bold">Dirección</label><textarea name="address" rows="2" class="w-full rounded-lg border-gray-300"></textarea></div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-bold">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 3. MODAL REGISTRAR DOCTOR --}}
        <div x-cloak x-show="currentModal === 'doctor'" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="closeModal()"></div>
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white">Nuevo Doctor</h3>
                        <button @click="closeModal()" class="text-blue-100 hover:text-white"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
                    </div>
                    
                    <form action="{{ route('doctors.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Nombre Completo *</label>
                            <input type="text" name="name" required class="w-full mt-1 rounded-lg border-gray-300">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Email *</label>
                                <input type="email" name="email" required class="w-full mt-1 rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Contraseña *</label>
                                <input type="password" name="password" required class="w-full mt-1 rounded-lg border-gray-300">
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Especialidad *</label>
                                <select name="specialty_id" required class="w-full mt-1 rounded-lg border-gray-300">
                                    <option value="" disabled selected>Seleccionar...</option>
                                    {{-- Lista de especialidades para el select de doctores --}}
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-500 uppercase">Licencia CMP</label>
                                <input type="text" name="professional_license" required class="w-full mt-1 rounded-lg border-gray-300">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase">Consultorio</label>
                            <input type="text" name="consulting_room" class="w-full mt-1 rounded-lg border-gray-300">
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold">Guardar Doctor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection