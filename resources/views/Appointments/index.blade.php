@extends('layouts.app')

@section('title', 'Citas Médicas')
@section('header', 'Control de Citas')

@section('content')

    {{-- CONTENEDOR PRINCIPAL ALPINE --}}
    <div x-data="appointmentManagement" class="space-y-8 pb-24">

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
                    Error al procesar:
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
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <input type="text" placeholder="Filtrar citas..." class="pl-10 w-full border-gray-200 rounded-xl py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-sm">
            </div>
            
            <button @click="openCreate()" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] flex items-center justify-center gap-2">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva Cita
            </button>
        </div>

        {{-- LISTADO DE CITAS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($appointments as $appointment)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 flex flex-col justify-between h-full relative overflow-hidden group">
                    
                    {{-- Banda lateral de estado --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5 
                        {{ $appointment->status == 'completed' ? 'bg-green-500' : '' }}
                        {{ $appointment->status == 'scheduled' ? 'bg-blue-500' : '' }}
                        {{ $appointment->status == 'canceled' ? 'bg-red-500' : '' }}
                        {{ $appointment->status == 'confirmed' ? 'bg-indigo-500' : '' }}">
                    </div>

                    <div>
                        {{-- Cabecera Card --}}
                        <div class="flex justify-between items-start mb-4 pl-3">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                                    {{ $appointment->appointment_date->format('d M, Y') }} • {{ date('H:i', strtotime($appointment->appointment_time)) }}
                                </p>
                                <h3 class="text-lg font-bold text-gray-900 line-clamp-1">
                                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                                </h3>
                            </div>
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-md 
                                {{ $appointment->status == 'completed' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $appointment->status == 'scheduled' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $appointment->status == 'canceled' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $appointment->status == 'confirmed' ? 'bg-indigo-100 text-indigo-700' : '' }}">
                                {{ $appointment->status }}
                            </span>
                        </div>

                        {{-- Info Doctor --}}
                        <div class="pl-3 space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-4 w-4 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                <span class="font-medium">Dr. {{ $appointment->doctor->user->name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="h-4 w-4 mr-2 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                {{ $appointment->specialty->name }}
                            </div>
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex items-center justify-end gap-2 border-t border-gray-100 pt-4 pl-3">
                        <button @click="openEdit({{ $appointment }})" class="text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                            Editar / Estado
                        </button>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cita?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-1 text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-3xl border-2 border-dashed border-gray-200">
                    <div class="bg-indigo-50 rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No hay citas programadas</h3>
                    <p class="text-gray-500 mt-1">Utiliza el botón superior para agendar una nueva.</p>
                </div>
            @endforelse
        </div>

        {{-- MODAL (CREAR / EDITAR) --}}
        <div x-cloak x-show="isModalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="isModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>
    
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="isModalOpen" @click.outside="closeModal()" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                    
                    <div class="bg-indigo-600 px-6 py-5 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-white" x-text="isEditMode ? 'Gestionar Cita' : 'Agendar Nueva Cita'"></h3>
                            <p class="text-sm text-indigo-200 mt-1">Complete los detalles de la consulta.</p>
                        </div>
                        <button @click="closeModal()" class="text-indigo-100 hover:text-white transition-colors">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
    
                    <form :action="isEditMode ? '/appointments/' + form.id : '{{ route('appointments.store') }}'" method="POST" class="p-8 space-y-6">
                        @csrf
                        <template x-if="isEditMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- PACIENTE --}}
                            <div class="col-span-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Paciente <span class="text-red-500">*</span></label>
                                <select name="patient_id" x-model="form.patient_id" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="" disabled>Seleccionar Paciente...</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }} ({{ $patient->dni }})</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ESPECIALIDAD --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Especialidad <span class="text-red-500">*</span></label>
                                <select name="specialty_id" x-model="form.specialty_id" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="" disabled>Seleccionar...</option>
                                    @foreach($specialties as $specialty)
                                        <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- DOCTOR --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Doctor Asignado <span class="text-red-500">*</span></label>
                                <select name="doctor_id" x-model="form.doctor_id" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="" disabled>Seleccionar...</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">Dr. {{ $doctor->user->name }} ({{ $doctor->specialty->name }})</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- FECHA --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Fecha <span class="text-red-500">*</span></label>
                                <input type="date" name="appointment_date" x-model="form.appointment_date" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                            </div>

                            {{-- HORA --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Hora <span class="text-red-500">*</span></label>
                                <input type="time" name="appointment_time" x-model="form.appointment_time" required class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                            </div>

                            {{-- ESTADO --}}
                            <div>
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Estado</label>
                                <select name="status" x-model="form.status" class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                                    <option value="scheduled">Programada</option>
                                    <option value="confirmed">Confirmada</option>
                                    <option value="completed">Completada</option>
                                    <option value="canceled">Cancelada</option>
                                </select>
                            </div>

                            {{-- OBSERVACIONES --}}
                            <div class="col-span-2">
                                <label class="text-xs font-bold text-gray-500 tracking-widest uppercase">Observaciones</label>
                                <textarea name="observation" x-model="form.observation" rows="2" class="w-full mt-1 px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all placeholder-gray-400" placeholder="Motivo de consulta o notas..."></textarea>
                            </div>
                        </div>
    
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="closeModal()" class="px-6 py-3 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm">Cancelar</button>
                            <button type="submit" class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 text-sm">
                                <span x-text="isEditMode ? 'Guardar Cambios' : 'Agendar Cita'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- LÓGICA ALPINE --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('appointmentManagement', () => ({
                isModalOpen: false,
                isEditMode: false,
                form: {
                    id: '',
                    patient_id: '',
                    doctor_id: '',
                    specialty_id: '',
                    appointment_date: '',
                    appointment_time: '',
                    status: 'scheduled',
                    observation: ''
                },
                resetForm() {
                    this.form = { id: '', patient_id: '', doctor_id: '', specialty_id: '', appointment_date: '', appointment_time: '', status: 'scheduled', observation: '' };
                },
                openCreate() {
                    this.resetForm();
                    this.isEditMode = false;
                    this.isModalOpen = true;
                },
                openEdit(appt) {
                    this.form = {
                        id: appt.id,
                        patient_id: appt.patient_id,
                        doctor_id: appt.doctor_id,
                        specialty_id: appt.specialty_id,
                        // Fix date format YYYY-MM-DD
                        appointment_date: appt.appointment_date ? appt.appointment_date.split('T')[0] : '',
                        // Fix time format HH:MM
                        appointment_time: appt.appointment_time, 
                        status: appt.status,
                        observation: appt.observation
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