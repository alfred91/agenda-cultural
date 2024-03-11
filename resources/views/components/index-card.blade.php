<a href="{{ route('user.event', $event->id) }}" class="block mx-auto mb-8 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
    <div class="relative bg-white shadow-xl overflow-hidden rounded-md hover:shadow-2xl h-full flex flex-col" style="width: 100%; max-width: 280px;">
        <img class="w-full h-48 object-cover" src="{{ asset('storage/events/' . $event->image) }}" alt="Imagen del evento">

        <div class="p-4 flex flex-col flex-grow">
            <div class="flex-grow">
                <div class="text-xl font-bold uppercase text-black">{{ $event->name }}</div>
                <div class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->isoFormat('DD MMMM YYYY') }}</div>
            </div>
            <p class="text-gray-600 mt-2">{{ Str::limit($event->description, 50) }}</p>
        </div>
    </div>
</a>
