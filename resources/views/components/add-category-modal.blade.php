    <div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Añadir Categoría</h3>
            <form method="POST" action="{{ route('admin.category.store') }}">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-black">
                </div>
                <div class="mt-6">
                    <x-danger-button type="button" @click="isOpen = false">
                        Cancelar
                    </x-danger-button>
                    <x-secondary-button type="submit">
                        Añadir
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </div>
