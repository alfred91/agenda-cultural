<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class EventCard extends Component
{
    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('components.event-card');
    }
}
