@extends('layouts.app')

@section('title', 'Citas Médicas')

@section('header', 'Gestión de Citas Médicas')

@section('content')
    <div class="space-y-6">

        <!-- BARRA DE HERRAMIENTAS Y FILTROS SIMPLIFICADA -->
        <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 border-t-4 border-indigo-600">
            <h2 class="text-xl font-bold text-gray-800">Listado de Citas</h2>
            
            <div class="flex flex-wrap items-center gap-3">
                <!-- Filtro por Fecha -->
                <input type="date" class="border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                
                <!-- Botón de Nueva Cita -->
                <button class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition font-semibold shadow-md">
                    + Agendar Nueva Cita
                </button>
            </div>
        </div>

        <!-- LISTA DE CITAS (Sin Paginación) -->
        <div class="space-y-4">
            
            <!-- CITA 1: COMPLETADA -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Datos Principales (Hora y Paciente) -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha y Hora</p>
                        <p class="text-lg font-extrabold text-indigo-700">09:00 AM</p>
                        <p class="text-base font-semibold text-gray-900">Paciente: Marta Rodríguez</p>
                    </div>

                    <!-- Columna de Especialidad y Médico -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detalle Médico</p>
                        <p class="text-base text-gray-700">Especialidad: Odontología</p>
                        <p class="text-base text-gray-700">Médico: Dr. Juan Pérez</p>
                    </div>

                    <!-- Columna de Estado -->
                    <div class="md:col-span-1 flex justify-start md:justify-center">
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 shadow-sm">
                            COMPLETADA
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-3 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Detalle (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Detalle
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Editar -->
                        <div class="text-sm space-x-2">
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-gray-500 hover:text-gray-700 transition">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CITA 2: PENDIENTE -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Datos Principales (Hora y Paciente) -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha y Hora</p>
                        <p class="text-lg font-extrabold text-indigo-700">11:00 AM</p>
                        <p class="text-base font-semibold text-gray-900">Paciente: Ana Gómez</p>
                    </div>

                    <!-- Columna de Especialidad y Médico -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detalle Médico</p>
                        <p class="text-base text-gray-700">Especialidad: Pediatría</p>
                        <p class="text-base text-gray-700">Médico: Dra. Laura Paz</p>
                    </div>

                    <!-- Columna de Estado -->
                    <div class="md:col-span-1 flex justify-start md:justify-center">
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 shadow-sm">
                            PENDIENTE
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-3 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Detalle (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Detalle
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Cancelar | Editar -->
                        <div class="text-sm space-x-2">
                            <a href="#" class="text-red-600 hover:text-red-800 transition">Cancelar</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-gray-500 hover:text-gray-700 transition">Editar</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CITA 3: CANCELADA -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200 opacity-60">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Datos Principales (Hora y Paciente) -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha y Hora</p>
                        <p class="text-lg font-extrabold text-indigo-700">02:30 PM</p>
                        <p class="text-base font-semibold text-gray-900">Paciente: Carlos Soto</p>
                    </div>

                    <!-- Columna de Especialidad y Médico -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detalle Médico</p>
                        <p class="text-base text-gray-700">Especialidad: Traumatología</p>
                        <p class="text-base text-gray-700">Médico: Dr. Pedro Gómez</p>
                    </div>

                    <!-- Columna de Estado -->
                    <div class="md:col-span-1 flex justify-start md:justify-center">
                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800 shadow-sm">
                            CANCELADA
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-3 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Detalle (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Detalle
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Reagendar | Editar -->
                        <div class="text-sm space-x-2">
                            <a href="#" class="text-green-600 hover:text-green-800 transition">Reagendar</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-gray-500 cursor-not-allowed transition">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mensaje de Fin de Lista (Sustituto de Paginación) -->
            <div class="text-center p-4 text-gray-500 font-medium">
                --- Fin del listado de citas ---
            </div>
        </div>
    </div>
@endsection