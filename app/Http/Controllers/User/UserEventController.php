<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserEventController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->get('category');
        $events = $categoryId ? Event::where('category_id', $categoryId)->paginate(8) : Event::paginate(8);
        $categories = Category::all();
        return view('user.agenda', compact('events', 'categories'));
    }
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('user.events.show', compact('event'));
    }
    // UserEventController.php

    public function filterEvents(Request $request, $period = 'all')
    {
        $eventsQuery = Event::query();

        switch ($period) {
            case 'week':
                $eventsQuery->where('date', '>=', now()->startOfWeek());
                break;
            case 'month':
                $eventsQuery->where('date', '>=', now()->startOfMonth());
                break;
        }

        $events = $eventsQuery->paginate(8);
        $categories = Category::all();

        return view('user.agenda', compact('events', 'categories'));
    }
}
