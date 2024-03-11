<a href="{{ route('user.event', $event->id) }}" class="relative block">
    <div class="relative max-h-44 bg-white rounded-lg shadow-lg overflow-hidden flex group" x-data="{ hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
        <div class="flex flex-col justify-between items-center w-1/10">
            <div class="text-4xl text-center font-bold text-white bg-red-500 rounded-r-lg px-2 max-h-20 w-20 py-1">
                <div>{{ \Carbon\Carbon::parse($event->date)->isoFormat('DD') }}</div>
                <div class="text-xs">{{ \Carbon\Carbon::parse($event->date)->isoFormat('MMMM') }}</div>
            </div>
        </div>
        <div class="p-4 flex-1">
            <div class="text-lg font-bold">{{ $event->name }}</div>
            <div class="text-gray-600 mb-4">{{ $event->city }}</div>
            <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
        </div>
        <div class="flex-shrink-0 w-1/2">
            <img class="w-full h-48 object-cover" src="{{ asset('storage/events/' . $event->image) }}" alt="Imagen del evento">
        </div>
        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background: rgba(0, 0, 0, 0.568);">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </div>
        <div class="absolute inset-0 bg-gray-800 bg-opacity-0 group-hover:bg-opacity-40 transition-all ease-in-out duration-500"></div>
    </div>
</a>
