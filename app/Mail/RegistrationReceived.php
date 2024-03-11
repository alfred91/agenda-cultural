<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $event;
    public $num_tickets;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Event $event, $num_tickets)
    {
        $this->user = $user;
        $this->event = $event;
        $this->num_tickets = $num_tickets;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $emailContent = "
            <h1>Inscripción Recibida</h1>
            <p>Hola {$this->user->name},</p>
            <p>Gracias por inscribirte en el evento: {$this->event->name}.</p>
            <p>Tienes {$this->num_tickets} tickets.</p>
            <p>Recuerda, el {$this->event->date} Te esperamos en {$this->event->city} {$this->event->address}
        ";

        return $this->subject('Inscricpión Recibida')
            ->html($emailContent);
    }
}
