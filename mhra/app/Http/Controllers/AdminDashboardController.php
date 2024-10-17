<?php

namespace App\Http\Controllers;

use App\Models\AnnualConference;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        $annual_conferences = AnnualConference::all();

        return view('dashboard', compact('events', 'annual_conferences'));
    }

}
