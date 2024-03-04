<div x-data="{
    isOpenEditEventModal: @entangle('isOpenEventModal'),
    selectedEventId: @entangle('selectedEventId'),
    event: {},
    async loadEvent() {
        if (this.selectedEventId) {
            const response = await fetch(`/admin/events/${this.selectedEventId}/edit`);
            this.event = await response.json();
            this.isOpenEditEventModal = true;
        }
    }
}" x-init="@this.watch('selectedEventId', () => loadEvent())">

    <div x-cloak x-show="isOpenEditEventModal" class="fixed z-10 inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full" @click.away="isOpenEditEventModal = false">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-lg mx-auto bg-white rounded-lg shadow-xl">
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-center text-gray-900 mb-4">Modificar Evento</h3>
                    <form method="POST" :action="`/admin/events/${event.id}`" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">

                        @method('PUT')
                        <input type="hidden" name="id" x-model="event.id">
                        <div class="space-y-4 w-auto">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del evento:</label>
                                <input type="text" name="name" id="name" x-model="event.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha:</label>
                                    <input type="date" name="date" id="date" x-bind:value="event.date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                </div>
                                <div class="w-1/2">
                                    <label for="time" class="block text-sm font-medium text-gray-700">Hora:</label>
                                    <input type="time" name="time" id="time" x-bind:value="event.time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                </div>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                <textarea name="description" id="description" rows="4" x-model="event.description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black"></textarea>
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Dirección:</label>
                                <input type="text" name="address" id="address" x-model="event.address" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/3">
                                    <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                                    <select name="category_id" id="category_id" x-model="event.category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" :selected="event.category_id == {{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-1/3">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Tipo:</label>
                                    <select name="type" id="type" x-model="event.type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                        <option value="online">Online</option>
                                        <option value="presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="w-1/3">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Estado:</label>
                                    <select name="status" id="status" x-model="event.status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                        <option value="created">Creado</option>
                                        <option value="finished">Terminado</option>
                                        <option value="canceled">Cancelado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <div class="w-1/3">
                                    <label for="max_capacity" class="block text-sm font-medium text-gray-700">Aforo Máximo:</label>
                                    <input type="number" name="max_capacity" id="max_capacity" x-model="event.max_capacity" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                </div>
                                <div class="w-2/3">
                                    <label for="max_tickets_per_person" class="block text-sm font-medium text-gray-700">Nº máximo de Entradas por Persona:</label>
                                    <input type="number" name="max_tickets_per_person" id="max_tickets_per_person" x-model="event.max_tickets_per_person" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                </div>
                            </div>
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Imagen:</label>
                                <input type="file" name="image" id="image" class="mt-1 block w-auto border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="button" @click="isOpenEditEventModal = false" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancelar
                            </button>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
