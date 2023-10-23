<?php

namespace App\Http\Controllers;

use App\Models\Blog; // Import the Blog model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // ... (other methods in your controller)

    // Show the form to create a new blog post
    public function create()
    {
        return view('blog.create'); // Create a new Blade template for the form if needed
    }

    // Store the new blog post in the database

    public function index()
    {
        $blogs = Blog::all();
        return view('BlogPosts', ['blogs' => $blogs]);
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new blog post
        Blog::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user' => Auth::id(),
        ]);

        // Redirect the user after creating the post
        return redirect('/blogs')->with('success', 'Blog post created successfully!');
    }



}
