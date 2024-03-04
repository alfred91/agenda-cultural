@extends('layouts.admin')

@section('header')
<h2 class="font-semibold text-xl text-blue-200 dark:text-gray-800 leading-tight">
    {{ __('Dashboard de Administrador') }}
</h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                <!-- Aquí puedes poner el contenido específico de tu dashboard de administrador -->
                <div class="py-12">
                    {{ __("Bienvenido Señor Admin") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
