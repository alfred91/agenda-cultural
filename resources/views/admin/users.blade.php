@extends('layouts.admin')

@section('header')
<h2 class="font-semibold text-xl text-blue-400 dark:text-blue-800 leading-tight">
    {{ __('Usuarios') }}
</h2>
@endsection

@section('content')
<div class="py-12" x-data="{ isOpenEventModal: false }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">
                @php
                $userHeaders = ['ID', 'Nombre', 'Email', 'Rol', 'Acciones'];
                $userRows = $users->map(function ($user) {
                $deleteButton = '<form action="'.route('admin.users.destroy', $user).'" method="POST" class="inline">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" onclick="return confirm(\'¿Estás seguro de que quieres eliminar a '. $user->name .' ?\');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded inline-flex items-center">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>';
                return [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $deleteButton,
                ];
                })->toArray();
                @endphp

                {{ $users->links() }}
                <x-responsive-table :headers="$userHeaders" :rows="$userRows" />

            </div>

        </div>
    </div>
</div>
@endsection
