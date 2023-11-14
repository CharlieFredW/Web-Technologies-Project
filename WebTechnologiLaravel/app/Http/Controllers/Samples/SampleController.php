<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Sample;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SampleController extends Controller
{
    public function create()
    {
        return view('createSamples');
    }

    public function store(Request $request) // store samples in the database
    {
        $request->validate([
            'title' => 'required', // required ensures that the field must be filled out in the form
            'url' => 'required',
            'bpm' => 'nullable|integer',
            'key' => 'nullable|string|max:255',
            'genre' => 'nullable|string|max:255',
            'instrument' => 'nullable|string|max:255',
        ]);

        $sample = new Sample;
        $sample->title = $request->input('title');
        $sample->url = $request->input('url');
        $sample->description = $request->input('description');
        $sample->bpm = $request->input('bpm');
        $sample->key = $request->input('key');
        $sample->genre = $request->input('genre');
        $sample->instrument = $request->input('instrument');
        $sample->image_url = $this->getRandomImage(); //add a random image url from the image folder to the database

        //owner should be the id of the user
        $sample->owner = auth()->user()->id;


        $sample->save();

        return redirect('/my-page-creator');
    }

    public function showSamples()
    {
        $this->AverageRating();

        $samples = Sample::all();

        foreach ($samples as $sample) {
            Log::info('Sample ID: ' . $sample->id . ' - Average Rating: ' . $sample->averageRating);
        }

        return view('samplePage', compact('samples'));

    }

    public function getRandomImage(): string
    {
        //get all images file path
        $imageFiles = array_map(
            fn($path) => basename($path),
            glob(public_path('images') . '/*')
        );

        //get a random images path
        $randomImageName = $imageFiles[array_rand($imageFiles)];

        //make the path short so it does not get the local::8080 in front so it works
        return $randomImageUrl = "images/{$randomImageName}";

    }

    public function rateSample(Request $request)
    {

        if (!Auth::check()) {
            // Check if user is logged in, if not go to login page
            return view('loginPage');
        }

        // Log the received data for debugging
        Log::info('Received sample_id: ' . $sampleId = $request->input('sample_id'));
        Log::info('Received rating: ' . $rating = $request->input('rating'));
        Log::info('Received user_id: ' . $request->user());


        // Validate the given input
        $request->validate([
            'sample_id' => 'required|integer', // Ensure the sample exists and it's not null
            'rating' => 'required|integer|between:1,5', // Rating should be between 1 and 5
        ]);

        /* Checks if a user has already given a rating to the specific sample
        and either creates or updates the users rating for that sample */

        try {
            $user = Auth::user();
            $user->ratings()->updateOrCreate(
                ['sample_id' => $sampleId],
                ['rating' => $rating]
            );
            return redirect('samplePage');

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error saving rating: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An error occurred while saving the rating.'], 500);

        }

    }

    public function averageRating()
    {
        $samples = Sample::all();

        // for each sample, take their ratings
        foreach ($samples as $sample) {
            $ratings = $sample->ratings()->pluck('rating')->toArray();

            // calculate the average rating for each rating and round it to 2 decimals
            if (!empty($ratings)) {
                $averageRating = $sample->ratings()->avg('rating');
                $roundedAverage = round($averageRating, 2);

                // logging for debugging
                Log::info('Sample ID: ' . $sample->id);
                Log::info('Ratings: ' . json_encode($ratings));
                Log::info('Average Rating: ' . $averageRating);
                Log::info('Rounded Average: ' . $roundedAverage);

                // store the rounded average rating  for eah sample in the database
                $sample->averageRating = $roundedAverage;
                $sample->save();
            }
        }
    }


}




