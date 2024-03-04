<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegistrationsModal extends Component
{
    public $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    public function render()
    {
        return view('components.registrations-modal');
    }
}
