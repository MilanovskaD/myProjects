<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $matches = Matches::with(['homeTeam', 'guestTeam'])->get();

        return view('admin.dashboard', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teams = Team::all();

        return view('admin.add-match', ['teams' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'home_team' => 'required',
            'guest_team' => 'required',
            'date' => 'required'
        ]);

        Matches::create([
            'home_team' => $validatedData ['home_team'],
            'guest_team' => $validatedData ['guest_team'],
            'date' => $validatedData ['date']
        ]);

        return redirect()->back()->with('success', 'Match created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $matches = Matches::all()->where('id', $id)->first();
        $teams = Team::all();

        return view('admin.edit-match', compact('matches', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('matches')
            ->where('id', $id)
            ->update([
                'home_team' => $request->input('home_team'),
                'guest_team' => $request->input('guest_team'),
                'date' => $request->input('date'),
                'result' => $request->input('result')
            ]);

        return redirect()->back()->with('success', 'Match updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('matches')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Match is deleted successfully');
    }
}
