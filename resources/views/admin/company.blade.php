@extends('layouts.admin')

@section('header')
<h2 class="font-semibold text-xl text-blue-200 dark:text-gray-800 leading-tight">
    {{ __('Empresas Admin') }}
</h2>
@endsection

@section('content')
<div class="py-12" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">

                <x-secondary-button @click="isOpen = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Añadir Empresa
                </x-secondary-button>
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

                <x-responsive-table :headers="$headers" :rows="$rows" />
                {{ $companies->links() }}

            </div>

            @include('components.add-company-modal', ['isOpen' => 'isOpen'])
        </div>
    </div>
</div>
@endsection