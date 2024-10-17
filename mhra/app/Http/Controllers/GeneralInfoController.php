<?php

namespace App\Http\Controllers;

use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generalInfo = GeneralInfo::first();

        return view('generalInfo.index', compact('generalInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $generalInfo = GeneralInfo::first();

        return view('generalInfo.edit', compact('generalInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralInfo $generalInfo)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg',
            'social_media_links' => 'nullable|array',
            'social_media_links.*' => 'nullable|url',
            'general' => 'nullable|string',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($generalInfo->hero_image_path) {
                Storage::delete($generalInfo->hero_image_path);
            }
            $heroImagePath = $request->file('hero_image')->store('hero_images', 'public');
            $generalInfo->hero_image_path = $heroImagePath;
        }

        $generalInfo->social_media_links = json_encode($request->input('social_media_links'));

        $generalInfo->general = $request->input('general');

        $generalInfo->save();

        return redirect()->route('generalInfo.index')->with('success', 'General info updated successfully.');
    }

}
