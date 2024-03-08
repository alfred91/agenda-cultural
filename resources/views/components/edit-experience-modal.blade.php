<div x-cloak x-show="isOpenEditExperienceModal" @click.away="isOpenEditExperienceModal = false" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center p-4">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg overflow-hidden shadow-2xl transform transition-all max-w-lg w-full">
            <form method="POST" :action="`/admin/experiences/${selectedExperienceId}`" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Editar Experiencia</h3>

                <div class="flex space-x-4">
                    <div class="w-1/2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" name="name" id="name" x-model="experience.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-1/2">
                        <label for="company_id" class="block text-sm font-medium text-gray-700">Empresa:</label>
                        <select name="company_id" id="company_id" x-model="experience.company_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar Empresa</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}" :selected="experience.company_id == {{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Descripción Corta:</label>
                    <textarea name="short_description" id="short_description" x-model="experience.short_description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="mt-4">
                    <label for="long_description" class="block text-sm font-medium text-gray-700">Descripción Larga:</label>
                    <textarea name="long_description" id="long_description" x-model="experience.long_description" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="flex space-x-4 mt-4">
                    <div class="w-1/3">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio:</label>
                        <input type="date" name="start_date" id="start_date" x-model="experience.start_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-1/3">
                        <label for="date_text" class="block text-sm font-medium text-gray-700">Texto de Fecha:</label>
                        <input type="text" name="date_text" id="date_text" x-model="experience.date_text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-1/3">
                        <label for="price_per_person" class="block text-sm font-medium text-gray-700">Precio por Persona:</label>
                        <input type="number" name="price_per_person" id="price_per_person" x-model="experience.price_per_person" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="mt-4">
                    <label for="link" class="block text-sm font-medium text-gray-700">Link:</label>
                    <input type="url" name="link" id="link" x-model="experience.link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen:</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full">
                    <div x-show="experience.image" class="mt-2">
                        <img :src="`/storage/experiences/${experience.image}`" class="max-w-24 mx-auto">
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <x-danger-button type="button" @click="isOpenEditExperienceModal = false">
                        Cancelar
                    </x-danger-button>
                    <x-secondary-button type="submit">
                        Guardar
                    </x-secondary-button>
                </div>
            </form>
        </div>
    </div>
</div>
