@extends('layouts.app')

@section('title', 'Pacientes')
@section('header', 'Gestión de Pacientes')

@section('content')

    {{-- 
      CONTENEDOR PRINCIPAL 
      Observa lo limpio que queda: x-data llama a la función definida al final 
    --}}
    <div x-data="patientManagement" class="space-y-8 pb-20">

        {{-- Mensajes Flash (Éxito) --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <div>
                    <p class="font-bold">¡Excelente!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- Mensajes de Error --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm animate-fade-in-down">
                <p class="font-bold flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Atención requerida:
                </p>
                <ul class="list-disc list-inside text-sm mt-1 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CABECERA: Buscador y Botón Crear --}}
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" placeholder="Buscar por nombre o DNI..." class="pl-10 w-full border-gray-200 rounded-xl py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm">
            </div>
            
            <button @click="openCreate()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nuevo Paciente
            </button>
        </div>

        {{-- LISTADO DE PACIENTES (Cards) --}}
        <div class="grid grid-cols-1 gap-6">
            @forelse ($patients as $patient)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex flex-col md:flex-row items-start md:items-center gap-6">
                    
                    {{-- Avatar / Iniciales --}}
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-2xl">
                            {{ substr($patient->first_name, 0, 1) }}{{ substr($patient->last_name, 0, 1) }}
                        </div>
                    </div>

                    {{-- Información Principal --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $patient->first_name }} {{ $patient->last_name }}</h3>
                        <div class="flex flex-wrap gap-3 mt-1 text-sm text-gray-500">
                            <span class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883-.393 1.627-1.066 2.127-1.473 1.067-1.637 2.803-1.637 2.803h5.273S12.627 8.193 11.153 7.127C10.48 6.627 10.087 5.883 10.087 5z"/></svg>
                                {{ $patient->dni ?? 'Sin DNI' }}
                            </span>
                            <span class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-md">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $patient->phone ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    {{-- Estado --}}
                    <div class="text-center px-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $patient->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-2 h-2 mr-2 rounded-full {{ $patient->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $patient->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                        <div class="text-xs text-gray-400 mt-1">
                            {{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->age . ' Años' : '-' }}
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex items-center gap-3 border-t md:border-t-0 border-gray-100 pt-4 md:pt-0 w-full md:w-auto justify-end">
                        <button @click="openEdit({{ $patient }})" class="text-gray-400 hover:text-indigo-600 transition-colors p-2 rounded-lg hover:bg-indigo-50 group">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" onsubmit="return confirm('¿Eliminar paciente permanentemente?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-gray-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20.573V15m0 0a2 2 0 100-4 2 2 0 000 4z"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No hay pacientes</h3>
                    <p class="text-gray-500 mt-1">Comienza registrando uno nuevo al sistema.</p>
                </div>
            @endforelse
        </div>

        {{-- 
            =================================================================
            MODAL REUTILIZABLE (SIRVE PARA CREAR Y EDITAR)
            =================================================================
        --}}
        <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            
            {{-- Backdrop Oscuro con Blur --}}
            <div x-show="isModalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>
    
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                {{-- Contenedor del Modal --}}
                <div x-show="isModalOpen" @click.outside="closeModal()"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    {{-- Cabecera Modal --}}
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900" x-text="isEditMode ? 'Editar Paciente' : 'Registrar Nuevo Paciente'"></h3>
                            <p class="text-sm text-gray-500 mt-1" x-text="isEditMode ? 'Actualiza la información clínica.' : 'Ingresa los datos básicos para la ficha.'"></p>
                        </div>
                        <button @click="closeModal()" class="text-gray-400 hover:text-gray-500 transition-colors bg-gray-50 hover:bg-gray-100 p-2 rounded-full">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
    
                    {{-- Formulario --}}
                    {{-- Nota: El :action cambia dinámicamente según el modo --}}
                    <form :action="isEditMode ? '/patients/' + form.id : '{{ route('patients.store') }}'" method="POST" class="p-8">
                        @csrf
                        {{-- Truco: agregamos el método PUT oculto solo si estamos editando --}}
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nombre --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">NOMBRE <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" x-model="form.first_name" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400" placeholder="Ej. Juan">
                            </div>
    
                            {{-- Apellido --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">APELLIDO <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" x-model="form.last_name" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400" placeholder="Ej. Pérez">
                            </div>
    
                            {{-- DNI --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">DNI</label>
                                <input type="text" name="dni" x-model="form.dni" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400">
                            </div>
    
                            {{-- Fecha Nacimiento --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">FECHA NACIMIENTO</label>
                                <input type="date" name="birth_date" x-model="form.birth_date" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 text-gray-500">
                            </div>
    
                            {{-- Teléfono --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">TELÉFONO</label>
                                <input type="tel" name="phone" x-model="form.phone" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400" placeholder="+51 999 999 999">
                            </div>
    
                            {{-- Email --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">CORREO ELECTRÓNICO</label>
                                <input type="email" name="email" x-model="form.email" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400" placeholder="juan@ejemplo.com">
                            </div>
    
                            {{-- Dirección (Ocupa 2 columnas) --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-sm font-bold text-gray-700 tracking-wide">DIRECCIÓN</label>
                                <textarea name="address" x-model="form.address" rows="2" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 font-medium text-gray-900 placeholder-gray-400 resize-none"></textarea>
                            </div>
                        </div>
    
                        {{-- Botones Footer --}}
                        <div class="mt-8 flex items-center justify-end gap-3">
                            <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm">
                                Cancelar
                            </button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 text-sm">
                                <span x-text="isEditMode ? 'Guardar Cambios' : 'Registrar Paciente'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div> 


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('patientManagement', () => ({
                isModalOpen: false,
                isEditMode: false,
                // Objeto formulario inicializado vacío
                form: {
                    id: '',
                    first_name: '',
                    last_name: '',
                    dni: '',
                    birth_date: '',
                    phone: '',
                    email: '',
                    address: ''
                },
                // Resetear formulario a valores vacíos
                resetForm() {
                    this.form = {
                        id: '', first_name: '', last_name: '', dni: '', 
                        birth_date: '', phone: '', email: '', address: ''
                    };
                },
                // Abrir modal para CREAR
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.isModalOpen = true;
                },
                // Abrir modal para EDITAR
                openEdit(patient) {
                    // Copiar datos del paciente al form
                    this.form = { ...patient };
                    
                    // Limpiar fecha si viene con hora
                    if(this.form.birth_date) {
                        this.form.birth_date = this.form.birth_date.split('T')[0];
                    }
                    
                    this.isEditMode = true;
                    this.isModalOpen = true;
                },
                // Cerrar modal
                closeModal() {
                    this.isModalOpen = false;
                }
            }));
        });
    </script>

@endsection