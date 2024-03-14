<?php

namespace App\Http\Controllers\Creator;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class CreatorEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('user_id', auth()->id())->get();
        $categories = Category::all();
        return view('creator.events', compact('events', 'categories'));
    }

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

        $eventData['user_id'] = auth()->id();

        Event::create($eventData);

        return back()->with('success', 'Evento creado');
    }


    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $event->time = Carbon::createFromFormat('H:i:s', $event->time)->format('H:i');
        return response()->json($event);
    }

    public function update(Request $request, Event $event)
    {
        $eventData = $request->except(['image']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('public/events');
            $eventData['image'] = basename($imagePath);
        }

        $event->update($eventData);

        return back()->with('success', 'Evento actualizado');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'cancelled']);

        return back()->with('success', 'Evento cancelado');
    }
}
