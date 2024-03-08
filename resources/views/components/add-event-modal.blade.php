<div x-show="isOpenAddEventModal" x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full z-10" @click.away="isOpenAddEventModal = false">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative w-full max-w-lg mx-auto bg-white rounded-lg shadow-xl">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-900 mb-4">Añadir Evento</h3>
                <form method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4 w-auto">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del evento:</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="date" class="block text-sm font-medium text-gray-700">Fecha:</label>
                                <input type="date" name="date" id="date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                            <div class="w-1/2">
                                <label for="time" class="block text-sm font-medium text-gray-700">Hora:</label>
                                <input type="time" name="time" id="time" value="00:00" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                            <textarea name="description" id="description" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black"></textarea>
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Ciudad:</label>
                            <input type="text" name="city" id="city" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección:</label>
                            <input type="text" name="address" id="address" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría:</label>
                                <select name="category_id" id="category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label for="type" class="block text-sm font-medium text-gray-700">Tipo:</label>
                                <select name="type" id="type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                                    <option value="presencial">Presencial</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>

                        </div>
                        <div class="flex space-x-4">
                            <div class="w-1/3">
                                <label for="max_capacity" class="block text-sm font-medium text-gray-700">Aforo Máximo:</label>
                                <input type="number" name="max_capacity" id="max_capacity" min="5" value="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                            <div class="w-2/3">
                                <label for="max_tickets_per_person" class="block text-sm font-medium text-gray-700">Nº máximo de Entradas por Persona:</label>
                                <input type="number" name="max_tickets_per_person" min="1" value="1" id="max_tickets_per_person" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                            </div>
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagen:</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-auto border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-black">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-danger-button type="button" @click="isOpenAddEventModal = false">
                                Cancelar
                            </x-danger-button>
                            <x-secondary-button type="submit">
                                Crear Evento
                            </x-secondary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
