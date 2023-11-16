<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerifyController extends Controller
{
    // show verification form
    public function showVerificationForm()
    {
        return view('emails.verification-page');
    }

    // verify the entered code
    public function verify(Request $request)
    {
        $enteredCode = $request->input('verification_code');
        $storedCode = Session::get('verification_code');

        if ($enteredCode == $storedCode) {
            // Verification successful, log in the user
            auth()->loginUsingId(Session::pull('user_id')); // Replace 'user_id' with your user identifier

            return redirect('/'); // Redirect to homepage after successful login
        }

        return back()->withErrors(['verification_code' => 'Invalid verification code']); // Redirect back with an error message on failed verification
    }
}
