<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Sample;
use Illuminate\Support\Facades\View;

class HomePageController extends Controller
{

    public function showHomepage() {
        $getNewSamples = $this->showNewSamples();
        $getTodaysSamples = $this->todaySamples();
        $getTodaysBlogs = $this->todayBlogPosts();
        $getThisWeeksCreators = $this->thisWeeksTopCreators();

        return View::make('home-page', [
            "newSamples" => $getNewSamples,
            "todaySamples" => $getTodaysSamples,
            "todayBlogPosts" => $getTodaysBlogs,
            "thisWeeksTopCreators" => $getThisWeeksCreators
        ]);
    }
    public function showNewSamples() {
        $newSamples = Sample::orderBy('created_at', 'desc')->take(6)->get();
        return $newSamples;
    }

    public function todaySamples() {
        $today = Carbon::today();

        $sortTodaySamples = Sample::whereDate('created_at', $today)
            ->orderBy('total_downloads', 'desc')
            ->take(6)->get();

        return $sortTodaySamples;
    }

    public function todayBlogPosts() {
        $sortBlogPosts = Blog::orderBy('created_at', 'desc')->take(3)->get();
        return $sortBlogPosts;
    }

    public function thisWeeksTopCreators() {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $topCreatorsThisWeek = Sample::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->orderBy('total_downloads', 'desc')
            ->take(8)->get();
        return $topCreatorsThisWeek;
    }


}

