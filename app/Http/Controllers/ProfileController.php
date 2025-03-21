<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:1000',
        ]);

        // Update the user
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio; // Assuming you have a bio column in your users table
        $user->save();

        return redirect()->route('profile')->with('status', 'Profile updated successfully!');
    }
}
