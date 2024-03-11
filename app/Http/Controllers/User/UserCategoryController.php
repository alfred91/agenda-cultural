<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('user.categories', compact('categories'));
    }

    /**
     * Display the experiences for a specific category.
     */
    public function show($categoryId)
    {
        $experiences = Experience::where('category_id', $categoryId)->get();
        return view('user.experiences', compact('experiences'));
    }
}
