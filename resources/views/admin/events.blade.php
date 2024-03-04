@extends('layouts.admin')

<div x-data="eventModal()">
    @include('components.add-event-modal')
    @include('components.edit-event-modal')
    @include('components.registrations-modal')

    @section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-blue-200 leading-tight">
            {{ __('Eventos Admin') }}
        </h2>
        <x-secondary-button @click="$dispatch('open-add-event-modal')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Añadir Evento
        </x-secondary-button>
    </div>
    @endsection

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">

                    @php
                    $headers = ['ID', 'Nombre', 'Fecha', 'Inscripciones','Modificar', 'Eliminar'];
                    $rows = $events->map(function ($event) {
                    $registrationsButton = '<button @click="openRegistrationsModal('.$event->id.')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-list-alt"></i></button>';
                    $editButton = '<button @click="openEditEventModal('.$event->id.')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit"></i></button>';
                    $deleteForm = '<form action="'.route('admin.events.destroy', $event->id).'" method="POST" onsubmit="return confirm(\'¿Estás seguro de que quieres eliminar este evento?\');">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold mt-4 py-1 px-2 rounded"><i class="fas fa-trash"></i></button>
                    </form>';
                    return [$event->id, $event->name, $event->date, $registrationsButton, $editButton, $deleteForm ];
                    })->toArray();
                    @endphp

                    <x-responsive-table :headers="$headers" :rows="$rows" />
                    {{ $events->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function eventModal() {
        return {
            isOpenAddEventModal: false
            , isOpenEditEventModal: false
            , isOpenRegistrationsModal: false
            , event: {}
            , registrations: []
            , selectedEventId: null
            , openAddEventModal() {
                this.isOpenAddEventModal = true;
                this.isOpenEditEventModal = false;
                this.isOpenRegistrationsModal = false;
            }
            , openEditEventModal(eventId) {
                this.selectedEventId = eventId;
                this.fetchEvent(eventId);
                this.isOpenAddEventModal = false;
                this.isOpenRegistrationsModal = false;
            }
            , openRegistrationsModal(eventId) {
                this.selectedEventId = eventId;
                this.isOpenRegistrationsModal = true;
                this.loadRegistrations(eventId);
            }
            , async fetchEvent(eventId) { //CARGAR EVENTOS
                try {
                    const response = await fetch(`/admin/events/${eventId}/edit`);
                    if (!response.ok) throw new Error('Error al cargar el evento');
                    const data = await response.json();
                    this.event = data;
                    this.isOpenEditEventModal = true;
                    this.isOpenAddEventModal = false;
                } catch (error) {
                    alert(error.message);
                }
            }
            , async loadRegistrations(eventId) { //CARGAR INSCRIPCIONES
                try {
                    const response = await fetch(`/admin/events/${eventId}/registrations`);
                    if (!response.ok) throw new Error('Error al cargar las inscripciones');
                    const data = await response.json();
                    this.registrations = data;
                    this.isOpenRegistrationsModal = true;
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message);
                }
            }
            , async cancelRegistration(registrationId) { //METODO BORRAR INSCRIPCIONES
                try {
                    const response = await fetch(`/admin/registrations/${registrationId}/cancel`, {
                        method: 'PATCH'
                        , headers: {
                            'Content-Type': 'application/json'
                            , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    if (!response.ok) throw new Error('Error al cancelar la inscripción');
                    this.isOpenRegistrationsModal = false;
                    location.reload();
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message);
                }
            }
            , init() {
                console.log('Componente inicializado');
                window.addEventListener('open-add-event-modal', () => {
                    this.openAddEventModal();
                });
            }
        , }
    }

</script>
