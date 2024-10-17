<?php

namespace App\Http\Controllers;

use App\Models\AnnualConference;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with('event')->get();
        $annual_conference = Ticket::with('annual_conference')->get();

        return view('tickets.index', compact('tickets', 'annual_conference'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::all();
        $conferences = AnnualConference::all();
        return view('tickets.create', compact('events', 'conferences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'price_per_person' => 'required|numeric',
            'price_per_company' => 'required|numeric',
            'event_id' => 'nullable|exists:events,id',
            'annual_conference_id' => 'nullable|exists:annual_conferences,id',
        ]);

        if (!$validated['event_id'] && !$validated['annual_conference_id']) {
            return redirect()->back()->withErrors(['error' => 'Please select either an event or an annual conference.']);
        }

        Ticket::create([
            'price_per_person' => $validated ['price_per_person'],
            'price_per_company' => $validated ['price_per_company'],
            'event_id' => $validated['event_id'],
            'annual_conference_id' => $validated['annual_conference_id'],
        ]);

        return redirect('tickets')->with('success', 'Ticket created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $events = Event::all();
        $ticket = Ticket::all()->where('id', $id)->first();

        return view('tickets.edit', compact('ticket', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'price_per_person' => 'required|numeric',
            'price_per_company' => 'required|numeric',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->event_id = $validated['event_id'];
        $ticket->price_per_person = $validated['price_per_person'];
        $ticket->price_per_company = $validated['price_per_company'];

        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
