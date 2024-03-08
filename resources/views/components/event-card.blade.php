<div class="relative max-h-44 bg-white rounded-lg shadow-lg overflow-hidden flex" x-data="{ hover: false }">
    <div class="flex flex-col justify-between items-center w-1/10">
        <div class="text-lg font-bold text-white bg-red-500 rounded-r-lg px-2 py-1">
            {{ $event->date }}
        </div>
        <div class="flex flex-col items-center">
            <a href="#" class="text-blue-600 hover:underline">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-blue-600 hover:underline">
                <i class="fab fa-facebook"></i>
            </a>
        </div>
    </div>
    <div class="p-4 flex-1">
        <div class="text-lg font-bold">{{ $event->name }}</div>
        <div class="text-gray-600 mb-4">{{ $event->city }}</div>
        <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
        <a href="{{ route('user.events.show', $event->id) }}" class="text-blue-600 hover:underline">Ver detalles</a>
    </div>
    <div class="flex-shrink-0 w-1/2">
        <img :class="hover ? 'opacity-50' : 'opacity-100'" @mouseenter="hover = true" @mouseleave="hover = false" class="w-full h-48 object-cover transition duration-300 ease-in-out" src="{{ asset('storage/events/' . $event->image) }}" alt="Imagen del evento">
    </div>
</div>
