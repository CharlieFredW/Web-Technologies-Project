<?php

namespace App\Http\Controllers\Samples;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sample;
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

        $samples = Sample::all();

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

}
