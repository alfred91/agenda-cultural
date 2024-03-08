<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryApiController extends Controller
{
    // Método para mostrar los eventos de una categoría específica
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $events = $category->events;
        return response()->json($events);
    }
}
