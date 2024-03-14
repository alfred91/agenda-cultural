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
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/3 h-full"> @if($event->image) <img src="{{ asset('storage/events/' . $event->image) }}" alt="Imagen del evento" class="w-full h-full object-cover"> @else <img src="{{ asset('images/users.svg') }}" alt="Imagen del evento" class="w-full h-full object-cover"> @endif </div>
                <div class="md:w-2/3 p-8">
                    <h1 class="text-4xl font-bold text-gray-800">{{ $event->name }}</h1>
                    <p class="mt-2 text-indigo-600 font-semibold">{{ $event->category->name }}</p>
                    <p class="mt-4 text-gray-600">{{ $event->short_description }}</p>
                    <div class="mt-6">
                        <div class="flex items-center"> <i class="fas fa-calendar-alt text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-clock text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ $event->time }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ $event->address }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-check text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ ucfirst($event->status) }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-users text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ $event->max_capacity }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-ticket-alt text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ $event->max_tickets_per_person }}</p>
                        </div>
                        <div class="flex items-center mt-2"> <i class="fas fa-info-circle text-gray-600 mr-2"></i>
                            <p class="text-gray-700">{{ $event->description }}</p>
                        </div>
                    </div>
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
