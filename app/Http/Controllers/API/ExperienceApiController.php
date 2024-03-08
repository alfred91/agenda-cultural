<?php

namespace App\Http\Controllers\API;

use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExperienceApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all()->map(function ($experience) {
            return [
                'id' => $experience->id,
                'name' => $experience->name,
                'start_date' => $experience->start_date,
                'date_text' => $experience->date_text,
                'short_description' => $experience->short_description,
                'long_description' => $experience->long_description,
                'price_per_person' => $experience->price_per_person,
                'link' => $experience->link,
                'company_id' => $experience->company_id,
                'image' => $experience->image ? url('storage/experiences/' . $experience->image) : null
            ];
        });

        return response()->json($experiences);
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
    public function show(string $id)
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
