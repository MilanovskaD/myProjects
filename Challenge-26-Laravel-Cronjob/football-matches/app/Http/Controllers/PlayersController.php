<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $players = Player::with('team')->get();
//        dd($players);
        return view('admin.players', ['players' => $players]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teams = Team::all();

        return view('admin.add-player', ['teams' => $teams]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'teams_id' => 'required'
        ]);

        Player::create([
            'name' => $validatedData ['name'],
            'birth_date' => $validatedData ['birth_date'],
            'teams_id' => $validatedData ['teams_id']
        ]);

        return redirect()->back()->with('success', 'Player created successfully!');
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
        $players = Player::all()->where('id', $id)->first();
        $teams = Team::all();

        return view('admin.edit-player', compact('players', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('players')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'birth_date' => $request->input('birth_date'),
                'teams_id' => $request->input('teams_id'),
            ]);

        return redirect()->back()->with('success', 'Player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('players')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Player is deleted successfully');
    }
}
