<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    //goes to login page
    public function showLoginForm()
    {
        return view('login-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /*return redirect('/'); // redirect to homepage*/
            $verificationCode = $this->generateVerificationCode();
            $this->sendVerificationCode($request->input('email'), $verificationCode);

            // Step 3: Store verification code in session
            Session::put('verification_code', $verificationCode);

            return redirect()->route('verify.show'); // redirect to verification page
        }

        return back()->withErrors(['email' => 'Invalid login credentials']); // Redirect back with an error message on failed login
    }

    // generate a random verification code
    private function generateVerificationCode()
    {
        return rand(100000, 999999);
    }

    // send the verification code to the user's email
    private function sendVerificationCode($email, $code)
    {
        Mail::to($email)->send(new VerificationCodeMail($code));
    }
}
