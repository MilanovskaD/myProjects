<?php

namespace App\Http\Controllers;

use App\Models\Speaker;
use Illuminate\Http\Request;

class SpeakersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speakers = Speaker::all();
        return view('speakers.index', compact('speakers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('speakers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'title' => 'required|string',
            'job_type' => 'required|string',
            'is_special_guest' => 'required|boolean',
            'social_media' => 'required|array',
            'social_media.*' => 'nullable|url',
        ]);

        Speaker::create([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'title' => $validated['title'],
            'job_type' => $validated['job_type'],
            'is_special_guest' => $validated['is_special_guest'],
            'social_media' => json_encode($validated['social_media']),
        ]);

        return redirect()->route('speakers.index')->with('success', 'Speaker created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $speaker = Speaker::all()->where('id', $id)->first();

        return view('speakers.edit', compact('speaker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'title' => 'required|string',
            'job_type' => 'required|string',
            'is_special_guest' => 'required|boolean',
            'social_media' => 'required|array',
            'social_media.*' => 'nullable|url',
        ]);

        $speaker = Speaker::findOrFail($id);

        $speaker->name = $validated['name'];
        $speaker->surname = $validated['surname'];
        $speaker->title = $validated['title'];
        $speaker->job_type = $validated['job_type'];
        $speaker->is_special_guest = $validated['is_special_guest'];
        $speaker->social_media = $validated['social_media'];

        $speaker->save();

        return redirect()->route('speakers.index')->with('success', 'Speaker updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $speaker = Speaker::findOrFail($id);
        $speaker->delete();

        return redirect()->route('speakers.index')->with('success', 'Speaker deleted successfully.');

    }
}
