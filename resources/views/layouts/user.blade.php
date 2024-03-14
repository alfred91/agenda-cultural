<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Agenda Culural') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- MENSAJES DEL CONTROLADOR -->
    @if(session('error'))
    <script>
        alert('{{ session("error") }}');

    </script>
    @endif

    @if(session('success'))
    <script>
        alert('{{ session("success") }}');

    </script>
    @endif

</head>
<body class="bg-gray-50 dark:bg-gray-200 font-sans antialiased">
    <div class="min-h-screen">
        @include('components.navbar-users')

        <header class="bg-white dark:bg-gray-400 shadow w-full">
            @yield('header')
        </header>

        <main>
            @yield('content')
        </main>
    </div>
    <x-footer />
</body>
</html>
