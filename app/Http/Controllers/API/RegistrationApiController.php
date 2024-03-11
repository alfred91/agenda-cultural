<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class RegistrationApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($dni)
    {
        $user = User::where('dni', $dni)->first();

        if (!$user) {
            return response()->json(['message' => 'Asistente no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $registrations = $user->registrations()->with('event')->get()->map(function ($registration) {
            return [
                'id' => $registration->id,
                'event_name' => $registration->event->name,
                'num_tickets' => $registration->num_tickets,
                'status' => $registration->status,
            ];
        });

        return response()->json($registrations);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($dni, $eventId)
    {
        // Buscar el usuario por DNI
        $user = User::where('dni', $dni)->first();

        if (!$user) {
            return response()->json(['message' => 'Asistente no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Buscar la inscripción para el usuario y el evento especificado
        $registration = $user->registrations()->where('event_id', $eventId)->with('event')->first();

        if (!$registration) {
            return response()->json(['message' => 'Inscripción no encontrada para el evento especificado'], Response::HTTP_NOT_FOUND);
        }

        // Personaliza la respuesta según tus necesidades
        $response = [
            'registration_id' => $registration->id,
            'event_name' => $registration->event->name,
            'num_tickets' => $registration->num_tickets,
            'status' => $registration->status,
            // Añade más campos según sea necesario
        ];

        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
