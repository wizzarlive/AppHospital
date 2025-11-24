<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediApp - @yield('title', 'Sistema')</title>

    {{-- 1. Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- 2. Alpine.js (Cargado aquí para que funcione en todas las vistas) --}}
    <script src="//unpkg.com/alpinejs" defer></script>


    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Oculta elementos hasta que Alpine cargue */
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">

        {{-- 3. Incluimos la Barra de Navegación Lateral --}}
        @include('layouts.navigation')

        {{-- Contenido Principal --}}
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">

            {{-- Header Superior --}}
            <header class="bg-white shadow-sm z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-bold text-gray-900">
                        @yield('header')
                    </h1>
                </div>
            </header>

            {{-- Contenido Variable --}}
            <main class="w-full flex-grow p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>