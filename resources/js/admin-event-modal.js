// admin-event-modal.js

function eventModal(data) {
    return {
        isOpenAddEventModal: false,
        isOpenEditEventModal: false,
        isOpenRegistrationsModal: false,
        event: {},
        registrations: [],
        selectedEventId: null,
        rolePrefix: data.rolePrefix,

        openAddEventModal() {
            this.resetModals();
            this.isOpenAddEventModal = true;
        },
        openEditEventModal(eventId) {
            this.resetModals();
            this.selectedEventId = eventId;
            this.fetchEvent(eventId);
        },
        openRegistrationsModal(eventId) {
            this.resetModals();
            this.selectedEventId = eventId;
            this.loadRegistrations(eventId);
        },
        async fetchEvent(eventId) {
            try {
                const response = await fetch(`/admin/events/${eventId}/edit`);
                if (!response.ok) throw new Error('Error al cargar el evento');
                const data = await response.json();
                this.event = data;
                this.isOpenEditEventModal = true;
            } catch (error) {
                console.error('Error:', error);
            }
        },
        async loadRegistrations(eventId) {
            try {
                const response = await fetch(`/admin/events/${eventId}/registrations`);
                if (!response.ok) throw new Error('Error al cargar las inscripciones');
                const data = await response.json();
                this.registrations = data;
                this.isOpenRegistrationsModal = true;
            } catch (error) {
                console.error('Error:', error);
            }
        },
        async cancelRegistration(registrationId) {
            try {
                const response = await fetch(`/admin/registrations/${registrationId}/cancel`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                if (!response.ok) throw new Error('Error al cancelar la inscripción');
                this.loadRegistrations(this.selectedEventId);
            } catch (error) {
                console.error('Error:', error);
            }
        },
        resetModals() {
            this.isOpenAddEventModal = false;
            this.isOpenEditEventModal = false;
            this.isOpenRegistrationsModal = false;
        },
        init() {
            window.addEventListener('open-add-event-modal', () => this.openAddEventModal());
            window.addEventListener('open-edit-event-modal', event => this.openEditEventModal(event.detail.id));
            window.addEventListener('open-registrations-modal', event => this.openRegistrationsModal(event.detail.id));
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const modal = eventModal({ rolePrefix: 'admin' });
    modal.init();
});
