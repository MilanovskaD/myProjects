<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withTrashed()->where('role', '=', 'user')->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft deletes the user (ban)

        return redirect()->route('users.index')->with('success', 'User has been banned.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();  // Restores the user, removing the 'deleted_at' timestamp

        return redirect()->route('users.index')->with('success', 'User has been unbanned.');
    }
}
