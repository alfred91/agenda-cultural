@extends('layouts.user')

@section('content')

<div x-data="{ open: false }">
    <div class="py-4 bg-gradient-to-r from-cyan-600 to-blue-500">
        <div class="mt-36">
            <h1 class="mt-12 text-6xl font-bold text-white text-center text-shadow">agenda</h1>
            <div class="mb-8 text-center ml-96 pl-96">
                <a href="{{ route('user.agenda') }}" class="mx-auto text-white font-bold hover:text-gray-300 text-2xl text-shadow">
                    Volver
                </a>
            </div>
        </div>
        <div class="flex justify-center mb-8 text-center">
        </div>
    </div>

    <div class="container mx-auto p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:flex md:items-start">
                <div class="md:w-3/4 p-8">
                    <h1 class="text-4xl font-bold text-black">{{ $event->name }}</h1>
                    <p class="mt-2 text-indigo-500 font-semibold">{{ $event->category->name }}</p>
                    <p class="mt-1 text-gray-600">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <p class="mt-4 text-gray-500">{{ $event->description }}</p>
                    <div class="mt-4">
                        <div class="text-gray-900 font-bold">Hora:</div>
                        <p class="text-gray-700">{{ $event->time }}</p>
                    </div>
                    <div class="mt-2">
                        <div class="text-gray-900 font-bold">Dirección:</div>
                        <p class="text-gray-700">{{ $event->address }}</p>
                    </div>
                    <div class="mt-2">
                        <div class="text-gray-900 font-bold">Estado:</div>
                        <p class="text-gray-700">{{ ucfirst($event->status) }}</p>
                    </div>
                    <div class="mt-2">
                        <div class="text-gray-900 font-bold">Aforo Máximo:</div>
                        <p class="text-gray-700">{{ $event->max_capacity }}</p>
                    </div>
                    <div class="mt-2">
                        <div class="text-gray-900 font-bold">Nº máximo de Entradas por Persona:</div>
                        <p class="text-gray-700">{{ $event->max_tickets_per_person }}</p>
                    </div>
                </div>
                <div class="md:w-1/4">
                    @if($event->image)
                    <img src="{{ asset('storage/events/' . $event->image) }}" alt="Imagen del evento" class="w-full object-cover">
                    @else
                    <img src="{{ asset('images/users.svg') }}" alt="Imagen del evento" class="w-full object-cover">
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-bold text-gray-900">Más Información</h2>
                        <!-- Aquí puedes agregar más información relevante sobre el evento -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <button @click="open = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">
            Inscribirse
        </button>
    </div>
    @include('components.user-registrations-modal')
</div>
</div>
@endsection
