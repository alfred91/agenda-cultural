@extends('layouts.admin')
@section('header')

<div x-data="{ isOpen: false }">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-blue-400 dark:text-blue-800 leading-tight">
            {{ __('Empresas') }}
        </h2>
        <div>
            <x-secondary-button @click="isOpen = true">
                Añadir Empresa
            </x-secondary-button>
        </div>
        @include('components.add-company-modal')
    </div>
    @endsection

    @section('content')
    <div class="py-12 items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                    @php
                    $headers = ['Nombre', 'Dirección', 'Teléfono', 'Correo electrónico', 'Sitio web', 'Información adicional', 'Acciones'];
                    $rows = $companies->map(function ($company) {
                    $deleteButton = '<form action="'.route('company.destroy', $company).'" method="POST">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" onclick="return confirm(\'¿Estás seguro de que quieres eliminar esta empresa?\');" class="text-white bg-red-500 hover:bg-red-700 font-bold py-1 px-2 rounded inline-flex items-center">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>';
                    return [
                    $company->name,
                    $company->address ?? 'N/A',
                    $company->phone ?? 'N/A',
                    $company->email ?? 'N/A',
                    $company->website ?? 'N/A',
                    $company->extra_info ?? 'N/A',
                    $deleteButton,
                    ];
                    })->toArray();
                    @endphp
                    {{ $companies->links() }}
                    <x-responsive-table :headers="$headers" :rows="$rows" />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
