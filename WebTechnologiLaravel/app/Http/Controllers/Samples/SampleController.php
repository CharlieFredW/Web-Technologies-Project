<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Sample;
use Illuminate\Support\Facades\Auth;

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

        // validate the given input
        $request->validate([
            'sample_id' => 'integer', // Ensure the sample exists
            'user_id' => 'integer', // Ensure that the owner exists
            'rating' => 'integer', // Rating should be between 1 and 5
        ]);

        try {
            // catch the exception
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while saving the rating.']);
        }

        $ratings = new Rating;
        $ratings->sample_id = $request->input('sample_id');
        $ratings->user_id = Auth::id(); // Assuming you have user authentication
        $ratings->rating = $request->input('rating');
        $ratings->save();




        /*success message?
        return response()->json(['message' => 'Rating saved successfully']);
        */
    }

}
