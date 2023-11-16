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

        if (Auth::attempt($credentials)) { // Checking if the entered email and password is correct

            // If the credentials are correct, generate a new verification code and send it to the users email
            $verificationCode = $this->generateVerificationCode();
            $this->sendVerificationCode($request->input('email'), $verificationCode);

            // The verification code is stored in the session
            Session::put('verification_code', $verificationCode);

            return redirect()->route('verify.show'); // Redirect to verification page
        }

        return back()->withErrors(['email' => 'Invalid login credentials']); // Error message on failed login
    }

    // Function to generate a random verification code
    private function generateVerificationCode()
    {
        return rand(100000, 999999);
    }

    // Function to send the verification code to the user's email
    private function sendVerificationCode($email, $code)
    {
        Mail::to($email)->send(new VerificationCodeMail($code));
    }
}
