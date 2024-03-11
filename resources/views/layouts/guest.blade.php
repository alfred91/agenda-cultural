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
    <div class="flex min-h-full">
        <div class="w-2/3 bg-cover bg-center" style="background-image: url('{{ asset('images/garrucha.avif') }}');"></div>
        <div class="w-1/3 flex flex-col justify-center items-start p-12 bg-blue-50 dark:bg-blue-300 content-with-diagonal-bg">
            <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">Agenda Cultural Garrucha</h1>
            <p class="text-gray-600 dark:text-white text-xl">
                Descubre los mejores eventos culturales en corazón del levante almeriense.
            </p>
            <div class="mt-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
