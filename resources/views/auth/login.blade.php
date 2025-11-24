<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso - MediApp</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="flex min-h-screen w-full">

        {{-- SECCIÓN IZQUIERDA: IMAGEN / BRANDING (Visible solo en pantallas grandes) --}}
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-900 relative items-center justify-center overflow-hidden">
            {{-- Capa de fondo con imagen --}}
            <div class="absolute inset-0 opacity-40">
                {{-- Imagen de fondo de hospital (Placeholder) --}}
                <img src="https://images.unsplash.com/photo-1538108149393-fbbd81895907?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                     alt="Hospital Background" class="w-full h-full object-cover">
            </div>
            
            {{-- Contenido sobre la imagen --}}
            <div class="relative z-10 text-center px-10">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 shadow-2xl">
                    <h1 class="text-4xl font-extrabold text-white tracking-tight">Bienvenido a MediApp</h1>
                    <p class="mt-4 text-indigo-100 text-lg">Sistema Integral de Gestión Clínica y Hospitalaria.</p>
                    <div class="mt-6 flex justify-center space-x-2">
                        <span class="h-2 w-2 bg-white rounded-full opacity-50"></span>
                        <span class="h-2 w-2 bg-white rounded-full"></span>
                        <span class="h-2 w-2 bg-white rounded-full opacity-50"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SECCIÓN DERECHA: FORMULARIO --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-gray-50">
            
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
                
                {{-- Cabecera del Formulario --}}
                <div class="text-center mb-10">
                    <div class="inline-flex bg-indigo-50 p-4 rounded-2xl mb-4 text-indigo-600 shadow-sm">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Iniciar Sesión</h2>
                    <p class="text-gray-500 mt-2">Ingrese sus credenciales para acceder.</p>
                </div>

                {{-- Errores de Validación --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Formulario --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-900 placeholder-gray-400 font-medium" 
                                placeholder="usuario@hospital.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Contraseña</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-900 placeholder-gray-400 font-medium" 
                                placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Botón de Ingreso --}}
                    <button type="submit" class="w-full py-4 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all duration-200 transform hover:-translate-y-0.5">
                        Acceder al Panel
                    </button>
                </form>

                {{-- Footer --}}
                <div class="mt-8 pt-6 border-t border-gray-100 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} MediApp System. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </div>
</body>
</html>