@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Panel de Administración Central')

@section('content')
    <div class="space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-indigo-600 hover:shadow-2xl transition duration-300 transform hover:-translate-y-0.5">
                <p class="text-sm font-medium text-gray-500 truncate">Citas Pendientes</p>
                <div class="flex items-center justify-between mt-2">
                    <div class="text-5xl font-extrabold text-indigo-700">45</div>
                    <div class="text-indigo-500 bg-indigo-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-green-600 hover:shadow-2xl transition duration-300 transform hover:-translate-y-0.5">
                <p class="text-sm font-medium text-gray-500 truncate">Nuevos Pacientes (Mes)</p>
                <div class="flex items-center justify-between mt-2">
                    <div class="text-5xl font-extrabold text-green-700">120</div>
                    <div class="text-green-500 bg-green-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-yellow-600 hover:shadow-2xl transition duration-300 transform hover:-translate-y-0.5">
                <p class="text-sm font-medium text-gray-500 truncate">Ocupación Promedio</p>
                <div class="flex items-center justify-between mt-2">
                    <div class="text-5xl font-extrabold text-yellow-700">75%</div>
                    <div class="text-yellow-500 bg-yellow-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-4v4m-4-4v4m-5 8h18a2 2 0 002-2V5a2 2 0 00-2-2H3a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-6 border-l-4 border-red-600 hover:shadow-2xl transition duration-300 transform hover:-translate-y-0.5">
                <p class="text-sm font-medium text-gray-500 truncate">Cancelaciones (Hoy)</p>
                <div class="flex items-center justify-between mt-2">
                    <div class="text-5xl font-extrabold text-red-700">3</div>
                    <div class="text-red-500 bg-red-100 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 bg-white shadow-xl rounded-2xl p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 border-b pb-4">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2 sm:mb-0">📅 Próximas Citas (Hoy)</h3>
                    <a href="/appointments" class="text-sm bg-indigo-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-indigo-700 transition shadow-md">
                        Ver Agenda Completa
                    </a>
                </div>
                
                <div class="space-y-3">
                    <div class="bg-indigo-50 p-4 rounded-xl flex justify-between items-center border border-indigo-200 hover:bg-indigo-100 transition duration-150 cursor-pointer">
                        <div>
                            <p class="text-base font-bold text-indigo-800">10:00 AM - Cardiología</p>
                            <p class="text-gray-900 font-medium truncate">Paciente: <span class="text-indigo-600">Juan Pérez</span></p>
                            <p class="text-sm text-gray-600">Médico: Dr. Carlos Médico</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold text-white bg-indigo-600 rounded-full shadow-sm">CONFIRMADA</span>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl flex justify-between items-center border border-gray-200 hover:bg-gray-100 transition duration-150 cursor-pointer">
                        <div>
                            <p class="text-base font-bold text-gray-800">11:30 AM - Pediatría</p>
                            <p class="text-gray-900 font-medium truncate">Paciente: <span class="text-gray-700">Ana Gómez</span></p>
                            <p class="text-sm text-gray-600">Médico: Dra. Laura Paz</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold text-gray-700 bg-yellow-300 rounded-full shadow-sm">PENDIENTE</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 bg-white shadow-xl rounded-2xl p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-4">📈 Ocupación Semanal</h3>
                <div class="relative h-64 w-full">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-gray-400 font-medium text-center p-4">Placeholder para Gráfica</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection