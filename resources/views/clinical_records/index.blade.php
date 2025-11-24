@extends('layouts.app')

@section('title', 'Historiales Clínicos')
@section('header', 'Historiales y Diagnósticos')

@section('content')

    {{-- Contenedor Alpine --}}
    <div x-data="clinicalManagement" class="space-y-8 pb-24">

        {{-- Mensajes Flash --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm flex items-center animate-fade-in-down">
                <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <p class="font-bold">¡Operación Exitosa!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm animate-fade-in-down">
                <p class="font-bold flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Atención:
                </p>
                <ul class="list-disc list-inside text-sm mt-1 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Cabecera: Buscador y Botón --}}
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" placeholder="Buscar diagnóstico, paciente..." class="pl-10 w-full border-gray-200 rounded-xl py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm">
            </div>
            
            <button @click="openCreate()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Nuevo Diagnóstico
            </button>
        </div>

        {{-- LISTADO DE HISTORIALES --}}
        <div class="grid grid-cols-1 gap-6">
            @forelse ($records as $record)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex flex-col md:flex-row gap-6">
                    
                    {{-- Columna Izquierda: Fecha --}}
                    <div class="flex-shrink-0 flex md:flex-col items-center md:items-start justify-between md:justify-start gap-2 md:w-32 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0 md:pr-4">
                        <div class="text-center md:text-left">
                            <span class="block text-3xl font-extrabold text-indigo-600">{{ $record->appointment->appointment_date->format('d') }}</span>
                            <span class="block text-xs font-bold text-gray-400 uppercase">{{ $record->appointment->appointment_date->format('M Y') }}</span>
                        </div>
                        <div class="bg-green-100 text-green-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Finalizado
                        </div>
                    </div>

                    {{-- Columna Derecha: Detalles --}}
                    <div class="flex-1 space-y-3">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    {{ $record->appointment->patient->first_name }} {{ $record->appointment->patient->last_name }}
                                </h3>
                                <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Dr. {{ $record->doctor->user->name }}
                                </p>
                            </div>
                            
                            {{-- Botones de Acción --}}
                            <div class="flex space-x-2">
                                <button @click="openEdit({{ $record }})" class="text-gray-400 hover:text-indigo-600 transition p-2 rounded-lg hover:bg-indigo-50">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('clinical_records.destroy', $record->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de borrar este historial?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2 rounded-lg hover:bg-red-50">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Caja de Diagnóstico --}}
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 relative">
                            <span class="absolute top-0 left-0 bg-indigo-100 text-indigo-600 text-[10px] font-bold px-2 py-0.5 rounded-br-lg rounded-tl-lg uppercase">Diagnóstico</span>
                            <p class="text-gray-800 font-medium text-sm leading-relaxed mt-2">
                                {{ $record->diagnosis ?? 'Sin diagnóstico registrado.' }}
                            </p>
                        </div>

                        {{-- Recetas y Notas --}}
                        @if($record->recipes)
                            <div class="flex items-start gap-2 text-sm text-indigo-700 bg-indigo-50/50 p-2 rounded-lg">
                                <svg class="h-5 w-5 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span><strong>Receta:</strong> {{ $record->recipes }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-gray-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Sin registros clínicos</h3>
                    <p class="text-gray-500 mt-1">Selecciona una cita pendiente para generar un diagnóstico.</p>
                </div>
            @endforelse
        </div>

        {{-- MODAL CREAR / EDITAR --}}
        <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            {{-- Backdrop --}}
            <div x-show="isModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                {{-- Contenido Modal --}}
                <div x-show="isModalOpen" @click.outside="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    <div class="bg-indigo-600 px-6 py-5 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white" x-text="isEditMode ? 'Editar Historial' : 'Nuevo Diagnóstico'"></h3>
                        <button @click="closeModal()" class="text-indigo-100 hover:text-white transition-colors p-1 rounded-full hover:bg-indigo-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <form :action="isEditMode ? '/clinical_records/' + form.id : '{{ route('clinical_records.store') }}'" method="POST" class="p-8 space-y-6">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        {{-- Selección de Cita --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Cita Asociada <span class="text-red-500">*</span></label>
                            
                            {{-- Si es CREAR: Mostramos solo disponibles --}}
                            <template x-if="!isEditMode">
                                <select name="appointment_id" x-model="form.appointment_id" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all text-gray-700">
                                    <option value="" disabled>Seleccionar Cita Pendiente...</option>
                                    @foreach($availableAppointments as $appt)
                                        <option value="{{ $appt->id }}">
                                            {{ $appt->patient->first_name }} {{ $appt->patient->last_name }} - {{ $appt->appointment_date->format('d/m/Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </template>

                            {{-- Si es EDITAR: Mostramos todas (o un input readonly) --}}
                            <template x-if="isEditMode">
                                <select name="appointment_id" x-model="form.appointment_id" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-100 border-transparent text-gray-500 cursor-not-allowed" readonly pointer-events-none>
                                    @foreach($allAppointments as $appt)
                                        <option value="{{ $appt->id }}">
                                            {{ $appt->patient->first_name }} {{ $appt->patient->last_name }} - {{ $appt->appointment_date->format('d/m/Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </template>
                            <p class="text-xs text-gray-400 mt-1" x-show="!isEditMode">Solo aparecen citas que aún no tienen historial.</p>
                        </div>

                        {{-- Diagnóstico --}}
                        <div>
                            <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Diagnóstico Médico <span class="text-red-500">*</span></label>
                            <textarea name="diagnosis" x-model="form.diagnosis" rows="3" class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all resize-none placeholder-gray-400" placeholder="Escriba el diagnóstico detallado..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Recetas --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Recetas / Medicación</label>
                                <textarea name="recipes" x-model="form.recipes" rows="4" class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all resize-none placeholder-gray-400" placeholder="Medicamentos indicados..."></textarea>
                            </div>
                            {{-- Notas --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Notas Adicionales</label>
                                <textarea name="notes" x-model="form.notes" rows="4" class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all resize-none placeholder-gray-400" placeholder="Observaciones privadas..."></textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm">Cancelar</button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 text-sm">
                                <span x-text="isEditMode ? 'Actualizar Registro' : 'Guardar Diagnóstico'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- Lógica JS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('clinicalManagement', () => ({
                isModalOpen: false,
                isEditMode: false,
                form: { id: '', appointment_id: '', diagnosis: '', notes: '', recipes: '' },
                
                resetForm() {
                    this.form = { id: '', appointment_id: '', diagnosis: '', notes: '', recipes: '' };
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.isModalOpen = true;
                },
                openEdit(record) {
                    this.form = { ...record }; 
                    this.isEditMode = true;
                    this.isModalOpen = true;
                },
                closeModal() {
                    this.isModalOpen = false;
                }
            }));
        });
    </script>
@endsection