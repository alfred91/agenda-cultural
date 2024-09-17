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
                <div class="md:w-1/3 h-full">
                    @if($event->image)
                    <img src="{{ asset('images/events/' . $event->image) }}" alt="Imagen del evento" class="w-full h-full object-cover">
                    @else
                    <img src="{{ asset('images/users.svg') }}" alt="Imagen del evento" class="w-full h-full object-cover">
                    @endif
                </div>
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

    <div class="text-center mt-4">
        <button @click="open = true" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition ease-in-out duration-150">
            Inscribirse
        </button>
    </div>

    <!-- Modal de inscripción -->
    <div x-show="open" x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full z-10" @click.away="open = false">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-lg mx-auto bg-white rounded-lg shadow-xl">
                <div class="p-4">
                    <h3 class="text-2xl font-semibold text-center text-gray-900 mb-4">Inscripción al Evento: {{ $event->name }}</h3>
                    <form method="POST" action="{{ route('user.registrations.store') }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div class="space-y-4 w-auto">
                            <div class="flex justify-center">
                                <div class="w-1/2">
                                    <label for="num_tickets" class="block text-sm font-medium text-gray-700">Número de entradas:</label>
                                    <input type="number" value="1" name="num_tickets" id="num_tickets" min="1" max="{{ $event->max_tickets_per_person }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="button" @click="open = false" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 transition ease-in-out duration-150">
                                Cancelar
                            </button>
                            <button type="submit" class="ml-3 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition ease-in-out duration-150">
                                Inscribirme
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
