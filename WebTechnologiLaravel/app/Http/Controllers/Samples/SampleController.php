<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Sample;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class SampleController extends Controller
{
    public function create()
    {
        return view('create-samples');
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

    public function showSamplesPage() {
        $showAllSamples = $this->showSamples();

        return View::make('sample-page', [
            "samples" => $showAllSamples
        ]);
    }

    public function showSamples() {

        $this->AverageRating();

        $samples = Sample::all();

        foreach ($samples as $sample) {
            Log::info('Sample ID: ' . $sample->id . ' - Average Rating: ' . $sample->averageRating);
        }

        return $samples;

    }

    public function updateTotalDownloads($sampleId) {
        //find sample where id =
        $sample = Sample::where('id', $sampleId)->first();

        if (!$sample) {
            return response()->json(['message' => 'Sample not found'], 404);
        }

        //increment total downloads
        $sample->total_downloads++;
        $sample->save();

        //add updatedCount for the promise in the js file to get the updated count so it can be used
        return response()->json(['updatedCount' => $sample->total_downloads]);
    }

    public function getRandomImage(): string
    {

        $imageFiles = glob(public_path('images') . '/*');

        $imageToExclude = public_path('images/avatar');

        //get all images file path
        $imageFiles = array_filter($imageFiles, function ($path) use ($imageToExclude) {
            return $path !== $imageToExclude;
        });

        $randomImagePath = $imageFiles[array_rand($imageFiles)];

        $randomImageUrl = basename($randomImagePath);

        return "images/{$randomImageUrl}";

    }

    public function destroy(Sample $sample)
    {
        // Check if the authenticated user is the owner of the sample post
        if (auth()->user()->id === $sample->owner) {
            $sample->delete();
            return redirect('/my-page-creator')->with('success', 'Sample deleted successfully!');
        } else {
            // Unauthorized attempt to delete
            return redirect('/')->with('error', 'Unauthorized action!');
        }
    }

    public function edit(Sample $sample)
    {
        if (auth()->user()->id === $sample->owner) {
            return view('edit-samples', compact('sample'));
        } else {
            // Unauthorized attempt to delete
            return redirect('/')->with('error', 'Unauthorized action!');
        }

    }

    // Updates the sample with the provided $id in the database
    public function update(Request $request, $id)
    {
        Sample::find($id)->update($request->all());

        // Redirect to a relevant page after the update, e.g., the sample's detail page
        return redirect()->route('my-page-creator');
    }

    public function rateSample(Request $request)
    {

        if (!Auth::check()) {
            // Check if user is logged in, if not go to login page
            return view('login-page');
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
            $user->rating()->updateOrCreate(
                ['sample_id' => $sampleId],
                ['rating' => $rating]
            );
            return redirect('sample-page');

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

    public function sortSamples(Request $request)
    {
        try {
            $sortType = $request->input('sortType');

            $samples = Sample::orderBy('total_downloads', $sortType)->get();

            $samplesArray = $samples->toArray();

            return response()->json(['samples' => $samplesArray, 'success' => true, 'message' => 'Sorting successful']);

        } catch (\Exception $e) {
            \Log::error('Exception in sortSamples: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }

}
