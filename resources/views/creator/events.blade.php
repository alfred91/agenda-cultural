@extends('layouts.creator')

@php // AGREGUÉ UN PREFIJO DE ROL PARA REUTILIZAR EL MODAL DE EDITAR EVENTOS CAMBIANDO UNA PARTE DE LA RUTA
$rolePrefix = 'creator';
@endphp

<div x-data="eventModal({ rolePrefix: '{{ $rolePrefix }}' })">
    @include('components.add-event-modal', ['route' => 'creator.events.store'])
    @include('components.edit-event-modal')
    @include('components.registrations-modal')

    @section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-blue-400 dark:text-blue-800 leading-tight">
            {{ __('Panel de Gestión de Eventos') }}
        </h2>
        <x-secondary-button @click="$dispatch('open-add-event-modal')">
            Añadir Evento
        </x-secondary-button>
    </div>
    @endsection

    @section('content')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 text-gray-900 dark:text-gray-100">

                    @php
                    $headers = ['ID', 'Nombre', 'Fecha', 'Hora', 'Descripción', 'Ciudad', 'Dirección', 'Estado', 'Capacidad', 'Tipo', 'Tickets Persona', 'Categoría', 'Imagen', 'Inscripciones', 'Acciones'];
                    $rows = $events->map(function ($event) {
                    $registrationsButton = '<button @click="$dispatch(\'open-registrations-modal\', { id: '.$event->id.' })" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 ml-8 px-2 rounded mr-2"><i class="fas fa-list-alt"></i></button>';
                    $editButton = '<button @click="$dispatch(\'open-edit-event-modal\', { id: '.$event->id.' })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded mr-2"><i class="fas fa-edit"></i></button>';
                    $deleteButton = '<form action="'.route('creator.events.destroy', $event->id).'" method="POST" onsubmit="return confirm(\'¿Estás seguro de que quieres cancelar este evento?\');" class="inline">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-1 rounded"><i class="fas fa-trash"></i></button>
                    </form>';

                    $imageUrl = asset("storage/events/" . $event->image);
                    $imageTag = "<img src='{$imageUrl}' alt='Imagen del evento' class='mx-auto block max-h-24 w-auto'>";
                    $status = $event->status === 'created' ? 'Creado' : ($event->status === 'finished' ? 'Finalizado' : ($event->status === 'cancelled' ? 'Cancelado' : $event->status));

                    return [
                    $event->id,
                    $event->name,
                    $event->date,
                    $event->time,
                    $event->description,
                    $event->city,
                    $event->address,
                    $status,
                    $event->max_capacity,
                    $event->type,
                    $event->max_tickets_per_person,
                    $event->category->name,
                    $imageTag,
                    $registrationsButton,
                    $editButton . $deleteButton
                    ];
                    })->toArray();
                    @endphp

                    <x-responsive-table :headers="$headers" :rows="$rows" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function eventModal(data) {
        return {
            isOpenAddEventModal: false
            , isOpenEditEventModal: false
            , isOpenRegistrationsModal: false
            , event: {}
            , registrations: []
            , selectedEventId: null
            , rolePrefix: data.rolePrefix,

            openAddEventModal() {
                this.resetModals();
                this.isOpenAddEventModal = true;
            }
            , openEditEventModal(eventId) {
                this.resetModals();
                this.selectedEventId = eventId;
                this.fetchEvent(eventId);
            }
            , openRegistrationsModal(eventId) {
                this.resetModals();
                this.selectedEventId = eventId;
                this.loadRegistrations(eventId);
            }
            , async fetchEvent(eventId) {

                try {
                    const response = await fetch(`/creator/events/${eventId}/edit`);
                    if (!response.ok) throw new Error('Error al cargar el evento');
                    const data = await response.json();
                    this.event = data;
                    this.isOpenEditEventModal = true;
                } catch (error) {
                    console.error('Error:', error);
                }
            }
            , async loadRegistrations(eventId) {
                try {
                    const response = await fetch(`/creator/events/${eventId}/registrations`);
                    if (!response.ok) throw new Error('Error al cargar las inscripciones');
                    const data = await response.json();
                    this.registrations = data;
                    this.isOpenRegistrationsModal = true;
                } catch (error) {
                    console.error('Error:', error);
                }
            }
            , async cancelRegistration(registrationId) {
                try {
                    const response = await fetch(`/creator/registrations/${registrationId}/cancel`, {
                        method: 'PATCH'
                        , headers: {
                            'Content-Type': 'application/json'
                            , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    if (!response.ok) throw new Error('Error al cancelar la inscripción');
                    this.loadRegistrations(this.selectedEventId);
                } catch (error) {
                    console.error('Error:', error);
                }
            }
            , resetModals() {
                this.isOpenAddEventModal = false;
                this.isOpenEditEventModal = false;
                this.isOpenRegistrationsModal = false;
            }
            , init() {
                window.addEventListener('open-add-event-modal', () => this.openAddEventModal());
                window.addEventListener('open-edit-event-modal', event => this.openEditEventModal(event.detail.id));
                window.addEventListener('open-registrations-modal', event => this.openRegistrationsModal(event.detail.id));
            }
        }
    }

</script>
