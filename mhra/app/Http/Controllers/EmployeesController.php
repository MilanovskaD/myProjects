<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string',
            'name' => 'required|string',
            'surname' => 'required|string',
            'short_bio' => 'nullable|string',
            'social_media' => 'nullable|array',
            'social_media.*' => 'nullable|url',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture_path'] = $path;
        }

        $validated['social_media'] = json_encode($validated['social_media']);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'short_bio' => 'nullable|string',
            'social_media' => 'nullable|array',
            'social_media.*' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $employee = Employee::findOrFail($id);

        if ($request->hasFile('profile_picture')) {

            if ($employee->profile_picture_path && Storage::exists($employee->profile_picture_path)) {
                Storage::delete($employee->profile_picture_path);
            }

            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures');

            $employee->profile_picture_path = $profilePicturePath;
        }


        $employee->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'job_title' => $validated['job_title'],
            'short_bio' => $validated['short_bio'],
            'social_media' => json_encode($validated['social_media']),
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');

    }
}
