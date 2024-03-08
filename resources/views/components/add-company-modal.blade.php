<div x-show="isOpen" @click.away="isOpen = false" class="fixed inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full" x-cloak>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-2xl transform transition-all max-w-lg w-full">
            <form method="POST" action="{{ route('admin.company.store') }}" class="p-6">
                @csrf
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Añadir Empresa</h3>

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Dirección:</label>
                        <input type="text" name="address" id="address" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                        <input type="text" name="phone" id="phone" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico:</label>
                        <input type="email" name="email" id="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700">Sitio web:</label>
                        <input type="url" name="website" id="website" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="extra_info" class="block text-sm font-medium text-gray-700">Información adicional:</label>
                        <textarea name="extra_info" id="extra_info" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <x-danger-button type="button" @click="isOpen = false">
                        Cancelar
                    </x-danger-button>
                    <x-secondary-button type="submit">
                        Crear
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </div>
</div>
