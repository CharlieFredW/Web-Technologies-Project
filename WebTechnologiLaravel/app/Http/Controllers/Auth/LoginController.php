<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //goes to login page
    public function showLoginForm()
    {
        return view('loginPage');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/'); // if login is successful return to page...
        }

        return back()->withErrors(['email' => 'Invalid login credentials']); // Redirect back with an error message on failed login
    }
}
