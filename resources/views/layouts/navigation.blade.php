{{-- 
    DISEÑO RESPONSIVO HÍBRIDO:
    1. Desktop: Barra lateral izquierda (Sidebar)
    2. Móvil: Barra de navegación inferior (Bottom Tab Bar)
--}}

{{-- ========================================== --}}
{{-- VISTA DESKTOP (Sidebar Lateral)            --}}
{{-- ========================================== --}}
<aside class="hidden md:flex flex-col w-64 bg-white shadow-xl border-r border-gray-200 z-30 h-full transition-all">
    <div class="p-6 flex flex-col h-full">
        
        {{-- Logo --}}
        <div class="text-center mb-8 pb-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-indigo-700 tracking-tight">MediApp</h2>
            <p class="text-xs text-gray-400 mt-1 tracking-widest uppercase">Gestión Clínica</p>
        </div>

        {{-- Menú Desktop --}}
        <nav class="space-y-2 flex-1 overflow-y-auto">
            
            {{-- Dashboard --}}
            <a href="/dashboard" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('dashboard*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('dashboard*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>

            {{-- Pacientes --}}
            <a href="{{ route('patients.index') }}" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('patients*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('patients*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Pacientes
            </a>

            {{-- Doctores --}}
            <a href="{{ route('doctors.index') }}" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('doctors*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('doctors*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Doctores
            </a>

            {{-- Especialidades (NUEVO) --}}
            <a href="{{ route('specialties.index') }}" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('specialties*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('specialties*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Especialidades
            </a>

            {{-- Citas --}}
            <a href="{{ route('appointments.index') }}" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('appointments*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('appointments*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Citas Médicas
            </a>

            {{-- Reportes (NUEVO - Placeholder) --}}
            <a href="/reports" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('reports*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('reports*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Reportes
            </a>

        </nav>

        {{-- Logout Desktop --}}
        <div class="mt-auto pt-6 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex w-full items-center p-2 rounded-xl hover:bg-red-50 hover:text-red-600 text-gray-600 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-gray-400 group-hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="font-medium">Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- ========================================== --}}
{{-- VISTA MÓVIL (Barra Inferior Fija)          --}}
{{-- ========================================== --}}
<nav class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 md:hidden z-50 pb-safe shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] overflow-x-auto">
    <div class="flex justify-between items-center h-16 px-4 min-w-max sm:min-w-0 sm:justify-around space-x-6 sm:space-x-0">
        
        {{-- Dashboard Móvil --}}
        <a href="/dashboard" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('dashboard*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="text-[9px] font-medium">Inicio</span>
        </a>

        {{-- Pacientes Móvil --}}
        <a href="{{ route('patients.index') }}" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('patients*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="text-[9px] font-medium">Pacientes</span>
        </a>

        {{-- Doctores Móvil --}}
        <a href="{{ route('doctors.index') }}" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('doctors*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-[9px] font-medium">Doctores</span>
        </a>

        {{-- Especialidades Móvil --}}
        <a href="{{ route('specialties.index') }}" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('specialties*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="text-[9px] font-medium">Espec.</span>
        </a>

        {{-- Citas Móvil --}}
        <a href="{{ route('appointments.index') }}" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('appointments*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-[9px] font-medium">Citas</span>
        </a>

        {{-- Reportes Móvil --}}
        <a href="/reports" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 {{ Request::is('reports*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="text-[9px] font-medium">Reportes</span>
        </a>

        {{-- Logout Móvil --}}
        <form method="POST" action="{{ route('logout') }}" class="h-full flex items-center">
            @csrf
            <button type="submit" class="flex flex-col items-center justify-center min-w-[3rem] space-y-1 text-gray-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[9px] font-medium">Salir</span>
            </button>
        </form>

    </div>
</nav>