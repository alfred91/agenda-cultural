<?php

namespace App\Http\Controllers\Creator;

use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreatorRegistrationController extends Controller
{
    public function index($eventId)
    {
        $registrations = Registration::where('event_id', $eventId)
            ->with('user')
            ->get()
            ->map(function ($registration) {
                return [
                    'id' => $registration->id,
                    'user_name' => $registration->user->name,
                    'num_tickets' => $registration->num_tickets,
                    'status' => $registration->status,
                ];
            });

        return response()->json($registrations);
    }

    public function create()
    {
        $events = Event::all();
        $users = User::all();
        return view('creator.registrations.create', compact('events', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'event_id' => 'required|integer|exists:events,id',
            'num_tickets' => 'required|integer',
            'status' => 'required|string',
        ]);

        Registration::create($validatedData);

        return back()->with('success', 'Inscripción creada.');
    }

    public function edit(Registration $registration)
    {
        $events = Event::all();
        $users = User::all();
        return view('creator.registrations.edit', compact('registration', 'events', 'users'));
    }

    public function update(Request $request, Registration $registration)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'event_id' => 'required|integer|exists:events,id',
            'num_tickets' => 'required|integer',
            'status' => 'required|string',
        ]);

        $registration->update($validatedData);

        return back()->with('success', 'Inscripción actualizada');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return back()->with('success', 'Inscripción eliminada');
    }

    public function cancel(Request $request, $registrationId)
    {
        $registration = Registration::findOrFail($registrationId);
        $registration->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Inscripción cancelada']);
    }
}
