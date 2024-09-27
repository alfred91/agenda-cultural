<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Agenda Cultural Garrucha</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-full bg-red-500 dark:bg-red-600 text-shadow">
    <div class="flex flex-col md:flex-row min-h-full relative">
        <!-- Background Image with Overlay for Title -->
        <div class="w-full md:w-2/3 bg-cover bg-center relative z-10 h-48 md:h-auto" style="background-image: url('{{ asset('images/garrucha.avif') }}');">
            <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Dark overlay for better text visibility -->
            <div class="relative z-20 flex flex-col justify-center items-center h-full text-center">
                <h1 class="text-3xl md:text-5xl font-bold text-white shadow-black">Agenda Cultural Garrucha</h1>
            </div>
        </div>

        <!-- Modal de Registro Mejorado -->
        <div id="registerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-75 hidden">
            <div class="bg-white p-8 rounded-lg shadow-lg relative w-full max-w-lg z-60 dark:bg-gray-800">
                <h2 class="text-3xl font-semibold mb-6 text-gray-900 dark:text-white">Registro</h2>
                <button onclick="closeRegisterModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Campos de Registro -->
                    <div class="space-y-4">
                        <!-- Nombre -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="name" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Apellido -->
                        <div>
                            <x-input-label for="surname" :value="__('Apellido')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="surname" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="text" name="surname" :value="old('surname')" required />
                            <x-input-error :messages="$errors->get('surname')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Edad -->
                        <div>
                            <x-input-label for="age" :value="__('Edad')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="age" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="number" name="age" :value="old('age')" min="0" required />
                            <x-input-error :messages="$errors->get('age')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="email" class="block w-full p-3" type="email" name="email" :value="old('email')" placeholder="tu_email@gmail.com" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="password" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="password" name="password" required autocomplete="new-password" minlength="8" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
                        </div>

                        <!-- DNI -->
                        <div>
                            <x-input-label for="dni" :value="__('DNI')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="dni" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="text" name="dni" pattern="\d{8}[A-Za-z]" title="Formato correcto: 12345678A" required />
                            <x-input-error :messages="$errors->get('dni')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Dirección -->
                        <div>
                            <x-input-label for="address" :value="__('Dirección')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="address" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="text" name="address" :value="old('address')" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Ciudad -->
                        <div>
                            <x-input-label for="city" :value="__('Ciudad')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="city" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="text" name="city" :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <x-input-label for="phone" :value="__('Teléfono')" class="text-gray-900 dark:text-white" />
                            <x-text-input id="phone" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" type="tel" name="phone" pattern="\d{9}" title="Introduce un número de teléfono válido de 9 dígitos" :value="old('phone')" required />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 text-red-500" />
                        </div>

                        <!-- Rol -->
                        <div>
                            <x-input-label for="role" :value="__('Rol')" class="text-gray-900 dark:text-white" />
                            <select id="role" name="role" class="block mt-1 w-full bg-gray-100 text-gray-900 border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="asistente">Asistente</option>
                                <option value="creador_eventos">Creador de Eventos</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-500" />
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-center justify-between mt-6">
                        <a class="underline text-sm text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-400" href="{{ route('login') }}">
                            {{ __('¿Ya estás registrado?') }}
                        </a>
                        <x-primary-button class="ms-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                            {{ __('Registrarse') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content Section -->
        <div class="w-full md:w-1/3 flex flex-col justify-center items-start p-6 md:p-12 bg-blue-50 dark:bg-blue-300 content-with-diagonal-bg">
            <div class="mt-6">
                <p class="text-lg md:text-xl text-gray-900 dark:text-gray-50 shadow-black mt-2">Descubre los mejores eventos culturales en el corazón del levante almeriense.</p>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
