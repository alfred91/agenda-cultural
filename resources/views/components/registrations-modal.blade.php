<div x-data="{
    isOpenEditEventModal: $wire.entangle('isOpenEventModal'),
    selectedEventId: $wire.entangle('selectedEventId'),
    event: {},
    async loadEvent() {
        if (this.selectedEventId) {
            const response = await fetch(`/admin/events/${this.selectedEventId}/edit`);
            this.event = await response.json();
            this.isOpenEditEventModal = true;
        }
    }
}" x-init="@this.watch('selectedEventId', () => loadEvent())">

    <div x-cloak x-show="isOpenRegistrationsModal" class="fixed inset-0 bg-gray-800 bg-opacity-40 overflow-y-auto h-full w-full" @click.away="isOpenRegistrationsModal = false" x-cloak>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative w-full max-w-lg mx-auto bg-white rounded-lg shadow-xl">
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
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="registration in registrations" :key="registration.id">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="registration.user_name"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="registration.num_tickets"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="registration.status"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <x-danger-button @click="cancelRegistration(registration.id)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar</x-danger-button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button @click="isOpenRegistrationsModal = false" type="button" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cerrar
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
