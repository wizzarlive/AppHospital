<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediApp - @yield('title', 'Cargando...')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>
    <div class="flex h-screen bg-gray-100">

        <aside class="flex flex-col w-64 bg-white shadow-xl transition-transform duration-300 ease-in-out z-30 border-r border-gray-200">
            <div class="p-6 flex flex-col h-full">

                <div class="text-center mb-10 pb-4 border-b">
                    <h2 class="text-3xl font-extrabold text-indigo-700 tracking-tight">MediApp</h2>
                    <p class="text-xs text-gray-500 mt-1">Gestión Clínica</p>
                </div>

                <nav class="space-y-3 flex-1">

                    <a href="/dashboard" class="flex items-center p-3 text-base font-semibold rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition duration-150 
                        {{ Request::is('dashboard') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-2-2m-3 2a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="/appointments" class="flex items-center p-3 text-base font-semibold rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition duration-150 
                        {{ Request::is('appointments') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Citas Médicas
                    </a>

                    <a href="/patients" class="flex items-center p-3 text-base font-semibold rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition duration-150 
                    {{ Request::is('patients') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20.573V15m0 0a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        Pacientes
                    </a>

                    <a href="/doctors" class="flex items-center p-3 text-base font-semibold rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition duration-150 
                    {{ Request::is('doctors') ? 'bg-indigo-50 text-indigo-600 shadow-sm' : 'text-gray-700' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20.573V15m0 0a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        Doctores
                    </a>
                </nav>

                <div class="mt-auto pt-6 border-t border-gray-200">
                    <a href="/logout" class="flex items-center space-x-3 p-2 bg-gray-100 rounded-xl hover:bg-red-50 hover:text-red-600 transition cursor-pointer text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <p class="font-semibold text-sm">Cerrar Sesión</p>
                    </a>
                </div>
            </div>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="bg-white shadow-md p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-900">
                        @yield('header')
                    </h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>

    </div>
</body>

</html>