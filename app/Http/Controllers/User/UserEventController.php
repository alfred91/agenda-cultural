<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserEventController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoryId = $request->get('category');

        // Inicia la consulta para obtener eventos desde hoy en adelante
        $eventsQuery = Event::where('date', '>=', Carbon::now()->toDateString());

        // Filtra por categoría si se proporciona una
        if ($categoryId) {
            $eventsQuery->where('category_id', $categoryId);
        }

        // Ordena los eventos por fecha de manera ascendente
        $events = $eventsQuery->orderBy('date', 'asc')->paginate(8);
        $categories = Category::all();

        return view('user.index', compact('events', 'categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function agenda(Request $request)
    {
        $categoryId = $request->get('category');
        $period = $request->get('period');

        $eventsQuery = Event::query();
        // FILTRO POR PERIODO
        if ($period === 'week') {
            $eventsQuery->whereBetween('date', [Carbon::now()->startOfWeek()->toDateString(), Carbon::now()->endOfWeek()->toDateString()]);
        } elseif ($period === 'month') {
            $eventsQuery->whereBetween('date', [Carbon::now()->startOfMonth()->toDateString(), Carbon::now()->endOfMonth()->toDateString()]);
        }
        // FILTRO POR CATEGORÍA
        if ($categoryId) {
            $eventsQuery->where('category_id', $categoryId);
        }

        $events = $eventsQuery->orderBy('date', 'asc')->paginate(8);
        $categories = Category::all();

        return view('user.agenda', compact('events', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('user.event', compact('event'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
