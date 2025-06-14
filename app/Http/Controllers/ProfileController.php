<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();
        
        return view('profile', compact('user'));
    }

    public function showEditProfileForm()
    {
        $user = auth()->user();
        
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];
        $user->phone = $validated['phone'];
        $user->address= $validated['address'];
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function deleteProfile()
    {
        $user = auth()->user();
        $user->delete();

        return redirect('/login')->with('success', 'Profile deleted successfully.');
    }
}
