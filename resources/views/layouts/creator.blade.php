<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
<body class="flex flex-col min-h-screen bg-blue-50 dark:bg-gray-200 font-sans antialiased">
    <div class="flex-grow">
        @include('components.navbar')

        <!-- Page Heading -->
        <header class="bg-white dark:bg-gray-400 shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center">
                @yield('header')
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow overflow-y-auto">
            @yield('content')
        </main>
    </div>
    <x-footer-creator />
</body>
</html>
