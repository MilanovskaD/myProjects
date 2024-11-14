<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $teams = Team::all();

        // Pass the teams to the 'admin.teams' view
        return view('admin.teams', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.add-team');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required',
            'foundation_year' => 'required'
        ]);

      Team::create([
          'name' => $validatedData ['name'],
          'foundation_year' => $validatedData ['foundation_year']
      ]);

        return redirect()->back()->with('success', 'Team created successfully!');

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
        $teams = Team::all()->where('id', $id)->first();

        return view('admin.edit-team', compact('teams'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('teams')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'foundation_year' => $request->input('foundation_year'),
            ]);

        return redirect()->back()->with('success', 'Team edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('teams')
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Team is deleted successfully');
    }
}
