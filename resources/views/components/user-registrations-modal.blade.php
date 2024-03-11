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
                                <input type="number" value="1" name="num_tickets" id="num_tickets" min="1" max="{{$event->max_tickets_per_person}}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="button" @click="open = false">
                            Cancelar
                        </x-primary-button>
                        <x-secondary-button class="ml-3" type="submit">
                            Inscribirme
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
