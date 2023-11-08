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

    public function showSamples() {

        $samples = Sample::all();

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
        // Log the received data for debugging
        Log::info('Received sample_id: ' . $request->input('sample_id'));
        Log::info('Received rating: ' . $request->input('rating'));
        Log::info('Received user_id: ' . $request->input('user_id'));


        // Validate the given input
        $request->validate([
            'sample_id' => 'required|integer', // Ensure the sample exists and it's not null
            'rating' => 'required|integer|between:1,5', // Rating should be between 1 and 5
            'user_id' => 'required|integer',
        ]);

        try {
            $ratings = new Rating;
            $ratings->sample_id = $request->input('sample_id');
            $ratings->user_id = Auth::id(); // Assuming you have user authentication
            $ratings->rating = $request->input('rating');
            $ratings->save();

            // Return a success response
            return response()->json(['message' => 'Rating saved successfully']);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error saving rating: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An error occurred while saving the rating.'], 500);
        }
    }

}



