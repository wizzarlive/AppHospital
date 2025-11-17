@extends('layouts.app')

@section('title', 'Pacientes')

@section('header', 'Gestión de Pacientes del Centro Médico')

@section('content')
    <?php
        if (!isset($patients)) {
            $patients = collect();
        }
    ?>
    <div class="space-y-6">

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                <p class="font-bold">¡Operación Exitosa!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                <p class="font-bold">Error de Validación:  Por favor, revisa los campos.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 border-t-4 border-indigo-600">
            
            <div class="relative w-full sm:w-1/2 lg:w-1/3">
                <input type="text" placeholder="Buscar por Nombre, DNI o Teléfono..." class="w-full pl-10 pr-4 py-3 border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150 text-base">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            
            <button onclick="openModal('registerPatientModal')" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition font-semibold shadow-md w-full sm:w-auto text-base">
                + Registrar Nuevo Paciente
            </button>
        </div>

        <div class="space-y-4">
            @forelse ($patients as $patient)
                <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 border border-gray-100 transition duration-300 hover:shadow-2xl hover:border-indigo-200">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        
                        <div class="md:col-span-4 space-y-1">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Paciente</p>
                            <p class="text-lg font-extrabold text-gray-900">{{ $patient->first_name }} {{ $patient->last_name }}</p>
                            <p class="text-base font-medium text-indigo-600">DNI: {{ $patient->dni ?? 'N/A' }}</p>
                        </div>

                        <div class="md:col-span-4 space-y-1 border-l md:pl-6 border-gray-200">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Contacto</p>
                            <p class="text-base text-gray-700">Teléfono: {{ $patient->phone ?? 'N/A' }}</p>
                            <p class="text-base text-gray-700">Email: {{ $patient->email ?? 'N/A' }}</p>
                        </div>

                        <div class="md:col-span-2 space-y-1 border-l md:pl-6 border-gray-200">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Fecha Nacimiento</p>
                            <p class="text-base text-gray-700">{{ $patient->birth_date ? (is_string($patient->birth_date) ? $patient->birth_date : $patient->birth_date->format('d/m/Y')) : 'N/A' }}</p>
                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $patient->is_active ?? true ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $patient->is_active ?? true ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div class="md:col-span-2 flex flex-col items-start md:items-end space-y-1 md:border-l md:pl-6 border-gray-200">
                            
                            <button onclick="openEditModal({{ $patient->id }}, '{{ $patient->first_name }}', '{{ $patient->last_name }}')" class="text-sm font-semibold text-gray-500 hover:text-indigo-800 transition">
                                Editar
                            </button>
                            
                            <button onclick="openModal('appointmentModal')" class="text-sm font-semibold text-green-600 hover:text-green-800 transition">
                                Agendar Cita
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-8 bg-white rounded-xl shadow-lg border-2 border-dashed border-gray-300">
                    <p class="text-xl font-semibold text-gray-700">No hay pacientes registrados aún.</p>
                    <p class="text-gray-500 mt-2">Usa el botón "Registrar Nuevo Paciente" para comenzar.</p>
                </div>
            @endforelse
            
            @if ($patients->isNotEmpty())
                <div class="text-center p-4 text-gray-500 font-medium">
                    --- Fin del listado de pacientes ---
                </div>
            @endif
        </div>
    </div>

    <div id="registerPatientModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-50 flex items-center justify-center hidden" tabindex="-1" aria-hidden="true">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
            <div class="bg-indigo-600 rounded-t-xl px-6 py-4 sm:px-8">
                <h3 class="text-xl font-bold text-white">Registrar Nuevo Paciente</h3>
            </div>
            
            <form action="{{ route('patients.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="first_name" id="first_name" required class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('first_name') }}">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-1">Apellido *</label>
                        <input type="text" name="last_name" id="last_name" required class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('last_name') }}">
                    </div>
                    <div>
                        <label for="dni" class="block text-sm font-semibold text-gray-700 mb-1">DNI</label>
                        <input type="text" name="dni" id="dni" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('dni') }}">
                    </div>
                    <div>
                        <label for="birth_date" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Nacimiento</label>
                        <input type="date" name="birth_date" id="birth_date" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('birth_date') }}">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                        <input type="tel" name="phone" id="phone" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="{{ old('email') }}">
                    </div>
                </div>
                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                    <textarea name="address" id="address" rows="3" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150">{{ old('address') }}</textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal('registerPatientModal')" class="px-5 py-2 text-base font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition shadow-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 text-base font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 transition shadow-md">
                        Guardar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="editPatientModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-50 flex items-center justify-center hidden" tabindex="-1" aria-hidden="true">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full">
            <div class="bg-indigo-600 rounded-t-xl px-6 py-4 sm:px-8">
                <h3 class="text-xl font-bold text-white">Editar Paciente: <span id="edit-patient-name"></span></h3>
            </div>
            
            {{-- La acción del formulario será actualizada por JavaScript al abrir el modal --}}
            <form id="editPatientForm" method="POST" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT') {{-- Esto es crucial para la ruta update --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="edit_first_name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre *</label>
                        <input type="text" name="first_name" id="edit_first_name" required class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                    <div>
                        <label for="edit_last_name" class="block text-sm font-semibold text-gray-700 mb-1">Apellido *</label>
                        <input type="text" name="last_name" id="edit_last_name" required class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                    <div>
                        <label for="edit_dni" class="block text-sm font-semibold text-gray-700 mb-1">DNI</label>
                        <input type="text" name="dni" id="edit_dni" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                    <div>
                        <label for="edit_birth_date" class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Nacimiento</label>
                        <input type="date" name="birth_date" id="edit_birth_date" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                    <div>
                        <label for="edit_phone" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                        <input type="tel" name="phone" id="edit_phone" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                    <div>
                        <label for="edit_email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="edit_email" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150" value="">
                    </div>
                </div>
                <div>
                    <label for="edit_address" class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                    <textarea name="address" id="edit_address" rows="3" class="block w-full border-gray-300 rounded-xl shadow-md py-2 px-4 text-base focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition duration-150"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal('editPatientModal')" class="px-5 py-2 text-base font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition shadow-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 text-base font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-md">
                        Actualizar Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="appointmentModal" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-50 flex items-center justify-center hidden" tabindex="-1" aria-hidden="true">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 transform transition-all sm:my-8 sm:align-middle">
            <div class="bg-green-600 rounded-t-xl px-6 py-4 sm:px-8">
                <h3 class="text-xl font-bold text-white">Agendar Nueva Cita</h3>
            </div>
            <div class="p-6 text-center">
                <p class="text-gray-700">Aquí irá el formulario para agendar una cita.</p>
                <button onclick="closeModal('appointmentModal')" class="mt-4 px-4 py-2 bg-gray-200 rounded-lg">Cerrar</button>
            </div>
        </div>
    </div>


    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                modal.setAttribute('aria-modal', 'true');
                modal.setAttribute('role', 'dialog');
            }
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                modal.removeAttribute('aria-modal');
                modal.removeAttribute('role');
            }
        }
        
        // Cierra el modal si se pulsa ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('registerPatientModal');
                closeModal('editPatientModal');
                closeModal('appointmentModal');
            }
        });

        // ----------------------------------------------------
        // FUNCIÓN CLAVE: Abre el Modal de Edición y Carga Datos
        // ----------------------------------------------------
        function openEditModal(patientId, firstName, lastName) {
            // 1. Configurar la acción del formulario
            const form = document.getElementById('editPatientForm');
            // Usamos una ruta temporal, DEBES ASEGURARTE DE QUE TENER LA RUTA 'patients.update' definida
            form.action = `/patients/${patientId}`; 
            
            // 2. Actualizar el título del modal
            document.getElementById('edit-patient-name').textContent = `${firstName} ${lastName}`;
            
            // 3. (OPCIONAL/MEJOR PRÁCTICA): Cargar los demás datos del paciente vía AJAX
            // Por ahora, solo precargamos lo que pasamos, pero para el DNI, email, etc.
            // necesitarías hacer una llamada a una ruta como /patients/{id}/data 
            // y luego llenar todos los campos (edit_dni, edit_email, etc.)
            
            // Ejemplo de llenado básico (solo nombre/apellido):
            document.getElementById('edit_first_name').value = firstName;
            document.getElementById('edit_last_name').value = lastName;
            
            // ABRE EL MODAL
            openModal('editPatientModal');
        }


    </script>
@endsection