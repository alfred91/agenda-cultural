<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::paginate(6);
        $companies = Company::all();
        return view('admin.experiences', compact('experiences', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'date_text' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'link' => 'nullable|url',
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $experience = new Experience();
        $experience->name = $request->name;
        $experience->start_date = $request->start_date;
        $experience->date_text = $request->date_text;
        $experience->short_description = $request->short_description;
        $experience->long_description = $request->long_description;
        $experience->price_per_person = $request->price_per_person;
        $experience->link = $request->link;
        $experience->company_id = $request->company_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/experiences');
            $experience->image = basename($imagePath);
        }
        $experience->save();

        return redirect()->route('admin.experiences')->with('success', 'Experiencia añadida con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return response()->json($experience);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'date_text' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'long_description' => 'required|string',
            'price_per_person' => 'required|numeric',
            'link' => 'nullable|url',
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->name = $request->name;
        $experience->start_date = $request->start_date;
        $experience->date_text = $request->date_text;
        $experience->short_description = $request->short_description;
        $experience->long_description = $request->long_description;
        $experience->price_per_person = $request->price_per_person;
        $experience->link = $request->link;
        $experience->company_id = $request->company_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/experiences');
            $experience->image = basename($imagePath);
        }
        $experience->save();

        return back()->with('success', 'Experiencia actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return back()->with('success', 'Experiencia eliminada con éxito.');
    }
}
