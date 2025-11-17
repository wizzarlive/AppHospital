@extends('layouts.app')

@section('title', 'Pacientes')

@section('header', 'Gestión de Pacientes del Centro Médico')

@section('content')
    <div class="space-y-6">

        <!-- BARRA DE HERRAMIENTAS Y BÚSQUEDA -->
        <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 border-t-4 border-indigo-600">
            
            <!-- Campo de Búsqueda -->
            <div class="relative w-full sm:w-1/2 lg:w-1/3">
                <input type="text" placeholder="Buscar por Nombre, DNI o Teléfono..." class="w-full pl-10 pr-4 py-2 border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            
            <!-- Botón de Nuevo Paciente -->
            <button class="bg-indigo-600 text-white px-5 py-2 rounded-xl hover:bg-indigo-700 transition font-semibold shadow-md w-full sm:w-auto">
                + Registrar Nuevo Paciente
            </button>
        </div>

        <!-- LISTA DE PACIENTES (Diseño en Tarjetas, sin paginación explícita) -->
        <div class="space-y-4">
            
            <!-- PACIENTE 1 -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Identificación -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</p>
                        <p class="text-lg font-extrabold text-gray-900">Juan Pérez Gómez</p>
                        <p class="text-base font-medium text-indigo-600">DNI: 12345678A</p>
                    </div>

                    <!-- Columna de Contacto -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</p>
                        <p class="text-base text-gray-700">Teléfono: +34 600 123 456</p>
                        <p class="text-base text-gray-700">Email: juan.perez@email.com</p>
                    </div>

                    <!-- Columna de Última Cita/Estado -->
                    <div class="md:col-span-2 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Última Cita</p>
                        <p class="text-base text-gray-700">01/11/2025</p>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Activo
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-2 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Historial (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Historial
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Editar | Agendar Cita -->
                        <div class="text-sm space-x-2">
                            <a href="#" class="text-gray-500 hover:text-gray-700 transition">Editar</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-green-600 hover:text-green-800 transition">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PACIENTE 2 -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Identificación -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</p>
                        <p class="text-lg font-extrabold text-gray-900">Ana Laura Soto</p>
                        <p class="text-base font-medium text-indigo-600">DNI: 98765432B</p>
                    </div>

                    <!-- Columna de Contacto -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</p>
                        <p class="text-base text-gray-700">Teléfono: +34 600 987 654</p>
                        <p class="text-base text-gray-700">Email: ana.soto@email.com</p>
                    </div>

                    <!-- Columna de Última Cita/Estado -->
                    <div class="md:col-span-2 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Última Cita</p>
                        <p class="text-base text-gray-700">05/10/2025</p>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pendiente
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-2 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Historial (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Historial
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Editar | Agendar Cita -->
                        <div class="text-sm space-x-2">
                            <a href="#" class="text-gray-500 hover:text-gray-700 transition">Editar</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-green-600 hover:text-green-800 transition">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PACIENTE 3 -->
            <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    
                    <!-- Columna de Identificación -->
                    <div class="md:col-span-4 space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</p>
                        <p class="text-lg font-extrabold text-gray-900">Ricardo Morales</p>
                        <p class="text-base font-medium text-indigo-600">DNI: 45678901C</p>
                    </div>

                    <!-- Columna de Contacto -->
                    <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</p>
                        <p class="text-base text-gray-700">Teléfono: +34 600 555 111</p>
                        <p class="text-base text-gray-700">Email: ricardo.morales@email.com</p>
                    </div>

                    <!-- Columna de Última Cita/Estado -->
                    <div class="md:col-span-2 space-y-1 border-l md:pl-6 border-gray-200">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Última Cita</p>
                        <p class="text-base text-gray-700">10/08/2025</p>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                            Inactivo
                        </span>
                    </div>

                    <!-- Columna de Acciones (Fija y Ordenada) -->
                    <div class="md:col-span-2 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                        <!-- ACCIÓN PRINCIPAL: Ver Historial (Fijo) -->
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            Ver Historial
                        </a>
                        <!-- ACCIONES SECUNDARIAS: Editar | Agendar Cita -->
                        <div class="text-sm space-x-2">
                            <a href="#" class="text-gray-500 hover:text-gray-700 transition">Editar</a>
                            <span class="text-gray-400">|</span>
                            <a href="#" class="text-green-600 hover:text-green-800 transition">Agendar Cita</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mensaje de Fin de Lista -->
            <div class="text-center p-4 text-gray-500 font-medium">
                --- Fin del listado de pacientes ---
            </div>
        </div>
    </div>
@endsection