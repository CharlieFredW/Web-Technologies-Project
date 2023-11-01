<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
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
        $sampleId = $request->input('sample_id');
        $rating = $request->input('rating');

        // 1. Validate the input
        $validatedData = $request->validate([
            'sample_id' => 'required|exists:samples,id', // Ensure the sample exists
            //'rating' => 'required|integer|between:1,5', // Rating should be between 1 and 5
        ]);

        // 2. Authenticate the user (ensure they are logged in)
        if (Auth::check()) {
            $sampleId = $request->input('sample_id');
            $rating = $request->input('rating');
        }

        // 3. Store the rating in the database
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication
        $user->ratings()->updateOrCreate(
            ['sample_id' => $sampleId],
            ['rating' => $rating]
        );

        // You might want to add some error handling here as well

        return response()->json(['message' => 'Rating saved successfully']);
    }

}
