<?php

namespace App\Http\Controllers;

use App\Models\Blog; // Import the Blog model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Show the form to create a new blog post
    public function create()
    {
        return view('blog.create'); // Create a new Blade if have to
    }
    public function store(Request $request)
    {
        //Get things that is required and validate them
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);


        // New blog post
        $blog = new Blog;

        $blog->title = $request->input('title');

        $blog->content = $request->input('content');

        $blog->user_id = Auth::id();


        //Save to the database
        $blog->save();

        // Redirect the user after creating blog post succesfully
        return redirect('/blogs')->with('success', 'Blog post created successfully!');
    }

    // Show the list of blog posts that users created
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blog-posts', ['blogs' => $blogs]);
    }

    //Delete the blog method
    public function delete(Blog $blog)
    {
        // Check if the user is authenticated and made the specific blog post
        if (auth()->user()->id === $blog->user_id) {
            $blog->delete();
            return redirect('/blogs')->with('success', 'Blog post deleted successfully!');
        } else {
            // Unauthorized attempt to delete
            return redirect('/blogs')->with('error', 'Unauthorized action!');
        }
    }

}

