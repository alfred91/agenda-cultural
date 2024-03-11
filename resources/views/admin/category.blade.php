@extends('layouts.admin')

@section('header')
<div x-data="{ isOpen: false }">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-blue-400 dark:text-blue-800 leading-tight">
            {{ __('Categorías') }}
        </h2>
        <div>
            <x-secondary-button @click="isOpen = true">
                Añadir Categoría
            </x-secondary-button>
        </div>
        @include('components.add-category-modal')
    </div>
    @endsection

    @section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">


                    @if($categories->count() > 0)
                    @php
                    $headers = ['ID', 'Nombre', 'Acciones'];
                    $rows = $categories->map(function ($category) {
                    $deleteButton = '<form action="'.route('admin.category.destroy', $category->id).'" method="POST" onsubmit="return confirm(\'¿Estás seguro de que quieres eliminar esta categoría?\');">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-flex items-center">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>';
                    return [$category->id, $category->name, $deleteButton];
                    })->toArray();
                    @endphp
                    {{ $categories->links() }}
                    <x-responsive-table :headers="$headers" :rows="$rows" />

                    @else
                    <p>No hay categorías disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
