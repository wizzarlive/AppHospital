@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panel de Control')

@section('content')
    <div class="space-y-8 pb-20">
        
        {{-- SECCIÓN 1: TARJETAS DE ESTADÍSTICAS (Datos Reales) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Citas Pendientes --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-indigo-600 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Citas Programadas</p>
                <div class="flex items-center justify-between mt-3">
                    {{-- Se usa la variable enviada por el controlador --}}
                    <div class="text-4xl font-extrabold text-indigo-700">{{ $pendingAppointments ?? '0' }}</div>
                    <div class="text-indigo-600 bg-indigo-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Nuevos Pacientes --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-green-500 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nuevos Pacientes (Mes)</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-green-600">{{ $newPatients ?? '0' }}</div>
                    <div class="text-green-600 bg-green-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Doctores --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-blue-500 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Personal Médico</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-blue-600">{{ $activeDoctors ?? '0' }}</div>
                    <div class="text-blue-600 bg-blue-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                </div>
            </div>

            {{-- Cancelaciones --}}
            <div class="bg-white shadow-sm rounded-2xl p-6 border-l-4 border-red-500 hover:shadow-md transition duration-300">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Cancelaciones (Hoy)</p>
                <div class="flex items-center justify-between mt-3">
                    <div class="text-4xl font-extrabold text-red-600">{{ $canceledToday ?? '0' }}</div>
                    <div class="text-red-600 bg-red-50 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- SECCIÓN 2: CONTENIDO PRINCIPAL --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- LISTA DE PRÓXIMAS CITAS (Ocupa 2 columnas) --}}
            <div class="lg:col-span-2 bg-white shadow-sm rounded-2xl p-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b border-gray-100 pb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span>📅</span> Próximas Citas
                    </h3>
                    <a href="{{ route('appointments.index') }}" class="text-sm text-indigo-600 font-semibold hover:text-indigo-800 hover:underline transition">
                        Ver Agenda Completa &rarr;
                    </a>
                </div>
                
                <div class="space-y-4">
                    {{-- Verificamos si la variable existe y tiene datos --}}
                    @if(isset($upcomingAppointments))
                        @forelse ($upcomingAppointments as $appointment)
                            <div class="bg-gray-50 p-4 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center border border-gray-100 hover:bg-indigo-50 hover:border-indigo-100 transition duration-150 group">
                                
                                <div class="flex items-start gap-4">
                                    {{-- Caja de Fecha --}}
                                    <div class="bg-white p-2 rounded-lg text-center border border-gray-200 min-w-[60px] shadow-sm">
                                        {{-- Formato de fecha seguro --}}
                                        <span class="block text-xs font-bold text-gray-400 uppercase">{{ $appointment->appointment_date ? $appointment->appointment_date->format('M') : '-' }}</span>
                                        <span class="block text-xl font-extrabold text-indigo-600">{{ $appointment->appointment_date ? $appointment->appointment_date->format('d') : '-' }}</span>
                                    </div>

                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-bold text-gray-500 bg-gray-200 px-2 py-0.5 rounded text-xs">
                                                {{-- Formato de hora --}}
                                                {{ date('H:i', strtotime($appointment->appointment_time)) }}
                                            </span>
                                            <span class="text-sm font-bold text-gray-800">
                                                {{-- Datos del Paciente (Relación) --}}
                                                {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                                            <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            {{-- Datos del Doctor (Relación Anidada) --}}
                                            Dr. {{ $appointment->doctor->user->name }} • {{ $appointment->specialty->name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-3 sm:mt-0 self-end sm:self-center">
                                    <a href="{{ route('appointments.index') }}" class="text-xs font-semibold text-indigo-600 bg-indigo-100 px-3 py-1.5 rounded-full hover:bg-indigo-200 transition">
                                        Detalles
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <div class="bg-gray-50 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-3">
                                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <p class="text-gray-500 font-medium">No hay citas próximas.</p>
                                <a href="{{ route('appointments.index') }}" class="text-indigo-600 text-sm font-bold mt-2 inline-block">Agendar Cita</a>
                            </div>
                        @endforelse
                    @else
                        <p class="text-red-500 p-4">Error: No se recibieron datos de citas.</p>
                    @endif
                </div>
            </div>

            {{-- COLUMNA DERECHA: Acciones Rápidas --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Panel de Acciones Rápidas --}}
                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 shadow-lg rounded-2xl p-6 text-white">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Acciones Rápidas
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('appointments.index') }}" class="block bg-white/10 hover:bg-white/20 p-3 rounded-xl transition flex items-center justify-between group">
                            <span class="font-medium">Nueva Cita</span>
                            <span class="bg-white text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold group-hover:scale-110 transition">+</span>
                        </a>
                        <a href="{{ route('patients.index') }}" class="block bg-white/10 hover:bg-white/20 p-3 rounded-xl transition flex items-center justify-between group">
                            <span class="font-medium">Registrar Paciente</span>
                            <span class="bg-white text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold group-hover:scale-110 transition">+</span>
                        </a>
                        <a href="{{ route('doctors.index') }}" class="block bg-white/10 hover:bg-white/20 p-3 rounded-xl transition flex items-center justify-between group">
                            <span class="font-medium">Registrar Doctor</span>
                            <span class="bg-white text-indigo-600 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold group-hover:scale-110 transition">+</span>
                        </a>
                    </div>
                </div>

                {{-- Panel Informativo Simple --}}
                <div class="bg-white shadow-sm rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Estado del Sistema</h3>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex justify-between">
                            <span>Doctores Disponibles:</span>
                            {{-- Usamos la variable o un fallback para evitar errores --}}
                            <span class="font-bold text-indigo-600">{{ $activeDoctors ?? '-' }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Pacientes Totales:</span>
                            {{-- Consulta directa como respaldo visual si no llega la variable --}}
                            <span class="font-bold text-indigo-600">{{ \App\Models\Patient::count() }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Citas Totales (Histórico):</span>
                            <span class="font-bold text-indigo-600">{{ \App\Models\Appointment::count() }}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection