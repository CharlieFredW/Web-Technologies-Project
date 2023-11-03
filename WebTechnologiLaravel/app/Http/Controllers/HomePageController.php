<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sample;
use Illuminate\Support\Facades\View;

class HomePageController extends Controller
{

    public function showHomepage() {
        $getNewSamples = $this->showNewSamples();
        $getTodaysSamples = $this->todaySamples();

        return View::make('homepage', [
            "newSamples" => $getNewSamples,
            "todaySamples" => $getTodaysSamples
        ]);
    }
    public function showNewSamples() {
        $newSamples = Sample::orderBy('created_at', 'desc')->get();
        return $newSamples;
    }

    public function todaySamples() {
        $today = Carbon::today();

        $sortTodaySamples = Sample::whereDate('created_at', $today)
            ->orderBy('total_downloads', 'desc')
            ->get();

        return $sortTodaySamples;
    }


}

