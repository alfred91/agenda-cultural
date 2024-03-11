<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use App\Models\Company;
use App\Models\Category;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserExperienceController extends Controller
{
    /**
     * Display a listing of the experiences.
     */
    public function index()
    {
        $categories = Category::all();
        return view('user.experiences', compact('categories'));
    }

    /**
     * Show the form for viewing the specified experience.
     */
    public function show($categoryId)
    {
        $events = Event::where('category_id', $categoryId)->get();
        $category = Category::find($categoryId);

        // Filtra las experiencias que pertenecen a las empresas asociadas con esos eventos
        $experiences = Experience::whereIn('company_id', $events->pluck('user.company.id'))->get();

        return view('user.experiences-show', compact('experiences', 'category'));
    }
}
