<div x-show="isOpenRegistrationsModal" x-cloak class="fixed inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full" @click.away="isOpenRegistrationsModal = false">
    <div class="flex items-center justify-center text-center min-h-screen p-4">
        <div class="relative w-auto max-w-xl mx-auto bg-white rounded-lg shadow-xl">
            <div class="p-6">
                <h3 class="text-2xl font-semibold text-center text-gray-900 mb-4">Inscripciones del Evento</h3>
                <div class="mt-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Entradas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-center">
                                <template x-for="registration in registrations" :key="registration.id">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="registration.user_name"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="registration.num_tickets"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="{'received': 'Recibida', 'confirmed': 'Confirmada', 'cancelled': 'Cancelada'}[registration.status]"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <x-danger-button @click="cancelRegistration(registration.id)" x-show="registration.status !== 'cancelled'">Cancelar</x-danger-button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button @click="isOpenRegistrationsModal = false" type="button">
                        Cerrar
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>
