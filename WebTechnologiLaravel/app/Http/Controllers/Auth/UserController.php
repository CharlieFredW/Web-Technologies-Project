<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('edit-profile-page', compact('user'));
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . auth()->id(),
        ]);

        auth()->user()->update(['name' => $request->name]);
        return back()->with('username_success', 'Username updated successfully.');
    }

    public function updatePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ]);

        $user = auth()->user();

        if ($user && Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            return back()->with('password_success', 'Password updated successfully.');
        } else {
            return back()->withErrors(['current_password' => 'Incorrect current password.'])->withInput();
        }
    }
}



