<?php

namespace App\Http\Controllers;

use App\Models\AnnualConference;
use App\Models\Speaker;
use Illuminate\Http\Request;

class AnnualConferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conferences = AnnualConference::with('speaker')->get();

        return view('conferences.index', compact('conferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $speakers = Speaker::all();
        return view('conferences.create', compact('speakers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'theme' => 'required|string',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required|string',
            'objective' => 'required|string',
            'status' => 'required|string',
            'speaker_id' => 'nullable|exists:speakers,id',
        ]);

        AnnualConference::create([
            'title' => $validated ['title'],
            'theme' => $validated ['theme'],
            'description' => $validated ['description'],
            'date' => $validated ['date'],
            'location' => $validated ['location'],
            'objective' => $validated ['objective'],
            'status' => $validated ['status'],
            'speaker_id' => $validated ['speaker_id'],

        ]);

        return redirect('conferences')->with('success', 'Conference created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $conferences = AnnualConference::all()->where('id', $id)->first();
        $speakers = Speaker::all();

        return view('conferences.edit', compact('conferences', 'speakers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'theme' => 'required|string',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required|string',
            'objective' => 'required|string',
            'status' => 'required|string',
            'speaker_id' => 'nullable|exists:speakers,id',

        ]);

        $conferences = AnnualConference::findOrFail($id);

        $conferences->title = $validated['title'];
        $conferences->theme = $validated['theme'];
        $conferences->description = $validated['description'];
        $conferences->date = $validated['date'];
        $conferences->location = $validated['location'];
        $conferences->objective = $validated['objective'];
        $conferences->status = $validated['status'];
        $conferences->speaker_id = $validated['speaker_id'];

        $conferences->save();

        return redirect()->route('conferences.index')->with('success', 'Conference updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $conference = AnnualConference::findOrFail($id);
        $conference->delete();

        return redirect()->route('conferences.index')->with('success', 'Conference deleted successfully.');
    }
}
