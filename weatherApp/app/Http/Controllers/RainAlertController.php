<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class RainAlertController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'city' => 'required|string|max:255',
        ]);

        Subscription::updateOrCreate(
            ['email' => $validated['email'], 'city' => $validated['city']]
        );

        return redirect()->back()->with('success', 'You will be notified when it rains in ' . $validated['city']);
    }
}
