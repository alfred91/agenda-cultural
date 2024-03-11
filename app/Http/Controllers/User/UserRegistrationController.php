<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistrationReceived;
use Illuminate\Support\Facades\Mail;

class UserRegistrationController extends Controller
{
    /**
     * Show the form for creating a new registration.
     */
    public function create($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('user.registrations.create', compact('event'));
    }

    /**
     * Store a newly created registration in storage.
     */ public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|integer|exists:events,id',
            'num_tickets' => 'required|integer',
        ]);

        $event = Event::findOrFail($request->event_id);
        $currentRegistrations = Registration::where('event_id', $event->id)->sum('num_tickets');

        if (($currentRegistrations + $request->num_tickets) > $event->max_capacity) {
            return back()->with('error', 'El nº de entradas solicitadas supera el aforo máximo del evento.');
        }

        if ($request->num_tickets > $event->max_tickets_per_person) {
            return back()->with('error', 'El nº de entradas solicitadas supera el máximo por persona.');
        }

        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->event_id = $request->event_id;
        $registration->num_tickets = $request->num_tickets;
        $registration->status = 'received';
        $registration->save();

        // Enviar el correo electrónico de prueba
        $user = Auth::user();
        $num_tickets = $request->num_tickets;
        Mail::to($user->email)->send(new RegistrationReceived($user, $event, $num_tickets));

        return back()->with('success', 'Inscripción Realizada!');
    }

    /**
     * Display a listing of the registrations.
     */
    public function index()
    {
        $registrations = Registration::where('user_id', Auth::id())->with('event')->get();
        return view('user.registrations.index', compact('registrations'));
    }
}
