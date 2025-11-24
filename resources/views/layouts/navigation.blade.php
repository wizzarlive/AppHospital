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
        <nav class="space-y-2 flex-1">
            
            {{-- Dashboard Link --}}
            <a href="/dashboard" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('dashboard*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                {{-- Icono Dashboard --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('dashboard*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>

            {{-- Pacientes Link --}}
            <a href="{{ route('patients.index') }}" class="group flex items-center p-3 text-sm font-semibold rounded-xl transition-all duration-200 ease-in-out {{ Request::is('patients*') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                {{-- Icono Users --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 {{ Request::is('patients*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Pacientes
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
<nav class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 md:hidden z-50 pb-safe shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
    <div class="flex justify-around items-center h-16 px-2">
        
        {{-- Dashboard Móvil --}}
        <a href="/dashboard" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Request::is('dashboard*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="text-[10px] font-medium">Inicio</span>
        </a>

        {{-- Pacientes Móvil --}}
        <a href="{{ route('patients.index') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Request::is('patients*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="text-[10px] font-medium">Pacientes</span>
        </a>

        {{-- Logout Móvil --}}
        <form method="POST" action="{{ route('logout') }}" class="w-full h-full">
            @csrf
            <button type="submit" class="flex flex-col items-center justify-center w-full h-full space-y-1 text-gray-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-[10px] font-medium">Salir</span>
            </button>
        </form>

    </div>
</nav>