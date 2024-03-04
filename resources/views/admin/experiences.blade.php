@extends('layouts.admin')
@section('header')

<div x-data="{ isOpen: false }">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-blue-200 dark:text-gray-800 leading-tight">
            {{ __('Experiencias') }}
        </h2>
        <x-secondary-button @click="isOpen = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Añadir Experiencia
        </x-secondary-button>
    </div>
    @include('components.add-experience-modal')
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">

                @php
                $headers = ['ID', 'Nombre', 'Descripción Corta', 'Descripción Larga', 'Fecha de Inicio', 'Texto de Fecha', 'Precio', 'Empresa', 'Acciones'];

                $rows = $experiences->map(function ($experience) {
                $editButton = '<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit"></i></button>';
                $deleteButton = '<form action="'.route('admin.experiences.destroy', $experience->id).'" method="POST" class="inline">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" onclick="return confirm(\'¿Estas seguro de que quieres eliminar esta experiencia?\');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-trash"></i></button>
                </form>';

                $fStartDate = \Carbon\Carbon::parse($experience->start_date)->format('d/m/Y');
                $sShortDescription = Str::limit($experience->short_description, 50);
                $sLongDescription = Str::limit($experience->long_description, 100);

                return [
                $experience->id,
                $experience->name,
                $sShortDescription,
                $sLongDescription,
                $fStartDate,
                $experience->date_text,
                number_format($experience->price_per_person, 2).'€',
                $experience->company->name ?? 'N/A',
                $editButton . ' ' . $deleteButton,
                ];
                })->toArray();
                @endphp

                <x-responsive-table :headers="$headers" :rows="$rows" />
                {{ $experiences->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
