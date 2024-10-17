<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\AnnualConference;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $events = Event::all();
        $annual_conference = AnnualConference::all();

        $agendas = Agenda::with(['event', 'annual_conference'])->paginate(10);

        return view('agenda.index', compact('agendas', 'events', 'annual_conference'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $conferences = AnnualConference::all();
        return view('agenda.create', compact('events', 'conferences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'hour' => 'required|array',
            'hour.*' => 'required|date_format:H:i',
            'title' => 'required|array',
            'title.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
            'event_id' => 'nullable|exists:events,id',
            'annual_conference_id' => 'nullable|exists:annual_conferences,id',
        ]);

        if (!$data['event_id'] && !$data['annual_conference_id']) {
            return redirect()->back()->withErrors(['error' => 'Please select either an event or an annual conference.']);
        }

        $agendaItems = [];
        for ($i = 0; $i < count($data['hour']); $i++) {
            $agendaItems[] = [
                'hour' => $data['hour'][$i],
                'title' => $data['title'][$i],
                'description' => $data['description'][$i],
            ];
        }

        Agenda::create([
            'details' => json_encode($agendaItems),
            'event_id' => $data['event_id'],
            'annual_conference_id' => $data['annual_conference_id'],
        ]);

        return redirect()->route('agenda.index')->with('success', 'Agenda items added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agenda = Agenda::findOrFail($id);

        $agendaItems = json_decode($agenda->details, true);

        return view('agenda.edit', compact('agenda', 'agendaItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $agenda = Agenda::findOrFail($id);

        $request->validate([
            'hour' => 'required|array',
            'hour.*' => 'required|date_format:H:i',
            'title' => 'required|array',
            'title.*' => 'required|string',
            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);

        $agendaItems = [];
        foreach ($request->hour as $index => $hour) {
            $agendaItems[] = [
                'hour' => $hour,
                'title' => $request->title[$index],
                'description' => $request->description[$index],
            ];
        }

        $agenda->details = json_encode($agendaItems);

        $agenda->save();

        return redirect()->route('agenda.index')->with('success', 'Agenda updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Agenda::findOrFail($id);
        $ticket->delete();

        return redirect()->route('agenda.index')->with('success', 'Agenda deleted successfully.');
    }
}
