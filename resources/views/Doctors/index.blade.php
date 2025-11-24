@extends('layouts.app')

@section('title', 'Doctores')
@section('header', 'Directorio Médico')

@section('content')

    {{-- CONTENEDOR PRINCIPAL ALPINE --}}
    <div x-data="doctorManagement" class="space-y-8 pb-24">

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
                    Atención requerida:
                </p>
                <ul class="list-disc list-inside text-sm mt-1 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- HEADER: Buscador y Botón --}}
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" placeholder="Buscar doctor, especialidad..." class="pl-10 w-full border-gray-200 rounded-xl py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm">
            </div>
            
            <button @click="openCreate()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nuevo Doctor
            </button>
        </div>

        {{-- LISTADO DE DOCTORES --}}
        <div class="grid grid-cols-1 gap-6">
            @forelse ($doctors as $doctor)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex flex-col md:flex-row items-start md:items-center gap-6">
                    
                    {{-- Icono / Foto --}}
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                           <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                    </div>

                    {{-- Datos --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-bold text-gray-900 truncate">Dr. {{ $doctor->user->name }}</h3>
                        
                        <div class="flex flex-wrap gap-3 mt-2 text-sm text-gray-500">
                            <span class="flex items-center gap-1 bg-indigo-50 text-indigo-700 px-2 py-1 rounded-md font-medium border border-indigo-100">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                {{ $doctor->specialty->name ?? 'Sin Especialidad' }}
                            </span>
                            <span class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                CMP: {{ $doctor->professional_license }}
                            </span>
                        </div>
                        
                        <div class="mt-2 text-sm text-gray-400 flex items-center gap-4">
                            <span class="flex items-center gap-1"><svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg> {{ $doctor->user->email }}</span>
                            @if($doctor->consulting_room)
                                <span class="flex items-center gap-1"><svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> {{ $doctor->consulting_room }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="flex items-center gap-3 border-t md:border-t-0 border-gray-100 pt-4 md:pt-0 w-full md:w-auto justify-end">
                        <button @click="openEdit({{ $doctor }})" class="text-gray-400 hover:text-indigo-600 transition-colors p-2 rounded-lg hover:bg-indigo-50 group" title="Editar">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro? Esto eliminará el acceso al sistema de este médico.');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50" title="Eliminar">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-gray-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Sin doctores registrados</h3>
                    <p class="text-gray-500 mt-1">Agrega al personal médico usando el botón superior.</p>
                </div>
            @endforelse
        </div>

        {{-- MODAL (REUTILIZABLE) --}}
        <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            
            {{-- Fondo oscuro --}}
            <div x-show="isModalOpen" 
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>
    
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                
                {{-- Contenedor Modal --}}
                <div x-show="isModalOpen" @click.outside="closeModal()"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    {{-- Cabecera --}}
                    <div class="bg-white px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900" x-text="isEditMode ? 'Editar Perfil Médico' : 'Registrar Nuevo Doctor'"></h3>
                            <p class="text-sm text-gray-500 mt-1" x-text="isEditMode ? 'Actualiza los datos profesionales.' : 'Crea un usuario y asigna especialidad.'"></p>
                        </div>
                        <button @click="closeModal()" class="text-gray-400 hover:text-gray-500 bg-gray-50 hover:bg-gray-100 p-2 rounded-full transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
    
                    {{-- Formulario --}}
                    <form :action="isEditMode ? '/doctors/' + form.id : '{{ route('doctors.store') }}'" method="POST" class="p-8">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- NOMBRE (User) --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Nombre Completo <span class="text-red-500">*</span></label>
                                <input type="text" name="name" x-model="form.name" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium placeholder-gray-400" placeholder="Dr. Juan Pérez">
                            </div>
    
                            {{-- EMAIL (User) --}}
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Email (Acceso) <span class="text-red-500">*</span></label>
                                <input type="email" name="email" x-model="form.email" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium placeholder-gray-400" placeholder="doctor@clinica.com">
                            </div>

                            {{-- ESPECIALIDAD --}}
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Especialidad <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="specialty_id" x-model="form.specialty_id" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium appearance-none text-gray-700">
                                        <option value="" disabled>Seleccione...</option>
                                        @foreach($specialties as $specialty)
                                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>
    
                            {{-- LICENCIA --}}
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Licencia CMP <span class="text-red-500">*</span></label>
                                <input type="text" name="professional_license" x-model="form.professional_license" required 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium placeholder-gray-400" placeholder="12345">
                            </div>
    
                            {{-- CONSULTORIO --}}
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Consultorio</label>
                                <input type="text" name="consulting_room" x-model="form.consulting_room" 
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium placeholder-gray-400" placeholder="Ej. 201">
                            </div>
                            
                            {{-- PASSWORD (Solo al crear) --}}
                            <div class="md:col-span-2 space-y-2" x-show="!isEditMode">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Contraseña Inicial <span class="text-red-500">*</span></label>
                                <input type="password" name="password" :required="!isEditMode"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all font-medium placeholder-gray-400" placeholder="Mínimo 8 caracteres">
                            </div>
                        </div>
    
                        {{-- Footer Botones --}}
                        <div class="mt-8 flex items-center justify-end gap-3">
                            <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm">
                                Cancelar
                            </button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 text-sm">
                                <span x-text="isEditMode ? 'Guardar Cambios' : 'Crear Doctor'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- LOGICA ALPINE --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('doctorManagement', () => ({
                isModalOpen: false,
                isEditMode: false,
                form: {
                    id: '',
                    name: '',     
                    email: '',    
                    specialty_id: '',
                    professional_license: '',
                    consulting_room: ''
                },
                resetForm() {
                    this.form = { id: '', name: '', email: '', specialty_id: '', professional_license: '', consulting_room: '' };
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.isModalOpen = true;
                },
                openEdit(doctor) {
                    // Llenamos el form combinando datos de la tabla doctors y la tabla users
                    this.form = {
                        id: doctor.id,
                        name: doctor.user.name, 
                        email: doctor.user.email,
                        specialty_id: doctor.specialty_id,
                        professional_license: doctor.professional_license,
                        consulting_room: doctor.consulting_room
                    };
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