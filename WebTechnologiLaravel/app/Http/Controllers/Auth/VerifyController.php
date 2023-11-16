<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyController extends Controller
{
    // show the 2FA verification form
    public function showVerificationForm()
    {
        return view('emails.verification-page');
    }

    // Verify the entered code
    public function verify(Request $request)
    {
        $enteredCode = $request->input('verification_code');
        $storedCode = Session::get('verification_code');

        if ($enteredCode == $storedCode) {
            // If the entered code is correct, log in the user
            auth()->loginUsingId(Session::pull('user_id'));

            return redirect('/'); // Redirect to homepage after successful login
        }

        // Error if the entered code is wrong
        return back()->withErrors(['verification_code' => 'Invalid verification code']);
    }
}
