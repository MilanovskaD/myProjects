<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('speaker')->get();

        return view('events.index', compact('events',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $speakers = Speaker::all();
        return view('events.create', compact('speakers'));
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
            'objective' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'speaker_id' => 'nullable|exists:speakers,id',
        ]);

        Event::create([
            'title' => $validated ['title'],
            'theme' => $validated ['theme'],
            'description' => $validated ['description'],
            'objective' => $validated ['objective'],
            'date' => $validated ['date'],
            'location' => $validated ['location'],
            'speaker_id' => $validated ['speaker_id'],
        ]);

        return redirect('events')->with('success', 'Event created successfully!');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $events = Event::all()->where('id', $id)->first();
        $speakers = Speaker::all();

        return view('events.edit', compact('events', 'speakers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'description' => 'required|string',
            'objective' => 'nullable|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'speaker_id' => 'nullable|exists:speakers,id',
        ]);

        $event = Event::findOrFail($id);

        $event->title = $validatedData['title'];
        $event->theme = $validatedData['theme'];
        $event->description = $validatedData['description'];
        $event->objective = $validatedData['objective'];
        $event->date = $validatedData['date'];
        $event->location = $validatedData['location'];
        $event->speaker_id = $validatedData['speaker_id'];

        $event->save();

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');

    }
}
