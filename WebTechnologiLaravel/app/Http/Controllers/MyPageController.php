<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sample;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MyPageController extends Controller
{

    public function showMyPage() {
        $getMySamples = $this->showMySamples();
        $getUsername = $this->showProfileName();

        return View::make('my-page-creator', [
            "mySamples" => $getMySamples,
            "username" => $getUsername
        ]);
    }

    public function showMySamples()
    {
        // Get the samples associated with the currently logged-in user
        $mySamples = Sample::where('owner', auth()->id())->get();

        // Debugging: Log the count of retrieved samples
        \Log::info('Number of samples: ' . count($mySamples));

        return $mySamples;
    }

    public function showProfileName()
    {
        $user = Auth::user();

        return $user;
    }



}

