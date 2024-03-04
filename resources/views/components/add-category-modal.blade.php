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
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Crear
                    </button>
                    <button type="button" @click="isOpen = false" class="ml-4 inline-flex justify-center rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
