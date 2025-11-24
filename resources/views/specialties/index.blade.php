@extends('layouts.app')

@section('title', 'Especialidades')
@section('header', 'Catálogo de Especialidades')

@section('content')

    {{-- CONTENEDOR ALPINE --}}
    <div x-data="specialtyManagement" class="space-y-8 pb-24">

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

        {{-- CABECERA: Botón Crear --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="w-full md:w-auto">
                <h2 class="text-lg font-medium text-gray-600">Administra las áreas médicas del hospital.</h2>
            </div>
            
            <button @click="openCreate()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva Especialidad
            </button>
        </div>

        {{-- LISTADO (GRID) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($specialties as $specialty)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex flex-col justify-between h-full group">
                    
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <div class="bg-indigo-50 p-3 rounded-xl text-indigo-600">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            </div>
                            
                            {{-- Menú de opciones (Editar/Borrar) --}}
                            <div class="flex space-x-2">
                                <button @click="openEdit({{ $specialty }})" class="text-gray-400 hover:text-indigo-600 transition p-1 rounded hover:bg-gray-100">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta especialidad?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-1 rounded hover:bg-gray-100">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900">{{ $specialty->name }}</h3>
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $specialty->description ?? 'Sin descripción' }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Personal</span>
                        <span class="bg-green-100 text-green-700 py-1 px-2 rounded-lg text-xs font-bold">
                            {{ $specialty->doctors_count }} Doctores
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-gray-50 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-3">
                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No hay especialidades</h3>
                    <p class="text-gray-500 mt-1">Registra las áreas médicas disponibles.</p>
                </div>
            @endforelse
        </div>

        {{-- MODAL REUTILIZABLE --}}
        <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="isModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>
    
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="isModalOpen" @click.outside="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    
                    <div class="bg-indigo-600 px-6 py-5 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-white" x-text="isEditMode ? 'Editar Especialidad' : 'Nueva Especialidad'"></h3>
                        <button @click="closeModal()" class="text-indigo-100 hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
    
                    <form :action="isEditMode ? '/specialties/' + form.id : '{{ route('specialties.store') }}'" method="POST" class="p-8 space-y-6">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
    
                        <div class="space-y-4">
                            {{-- Nombre --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Nombre <span class="text-red-500">*</span></label>
                                <input type="text" name="name" x-model="form.name" required 
                                    class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium" placeholder="Ej. Neurología">
                            </div>

                            {{-- Descripción --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Descripción</label>
                                <textarea name="description" x-model="form.description" rows="3" 
                                    class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium resize-none" placeholder="Breve descripción del área..."></textarea>
                            </div>
                        </div>
    
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm">Cancelar</button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 text-sm">
                                <span x-text="isEditMode ? 'Guardar Cambios' : 'Crear Especialidad'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- JS --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('specialtyManagement', () => ({
                isModalOpen: false,
                isEditMode: false,
                form: { id: '', name: '', description: '' },
                resetForm() {
                    this.form = { id: '', name: '', description: '' };
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.isModalOpen = true;
                },
                openEdit(specialty) {
                    this.form = { ...specialty };
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