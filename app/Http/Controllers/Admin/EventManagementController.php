<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(5);
        $categories = Category::all();
        return view('admin.events', compact('events', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'created',
            'max_capacity' => 'required|integer',
            'type' => 'required|in:online,presencial',
            'max_tickets_per_person' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $eventData = $request->except(['image']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('public/events');
            $eventData['image'] = basename($imagePath);
        }


        // Añade el ID del usuario que crea el evento
        $eventData['user_id'] = auth()->id();

        Event::create($eventData);

        return back()->with('success',  'Evento creado con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $event->time = Carbon::createFromFormat('H:i:s', $event->time)->format('H:i');
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $eventData = $request->except(['image']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('public/events');
            $eventData['image'] = basename($imagePath);
        }

        $event->update($eventData);

        return back()->with('success',  'Evento actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        // SI EL EVENTO TIENE INSCRIPCIONES MOSTRAMOS UN MENSAJE Y NO SE BORRA
        if ($event->registrations()->count() > 0) {
            return back()->with('error', 'El evento no se puede eliminar por que tiene inscripciones asociadas.');
        }
        // DE LO CONTRARIO, LO ELIMINAMOS
        $event->delete();

        return back()->with('success', 'Evento eliminado');
    }
}
