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
        return view('blog.create'); // Create a new Blade template for the form if needed
    }

    // Store the new blog post in the database
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);


        // Create a new blog post
        $blog = new Blog;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->user_id = Auth::id();


        //Save to the database
        $blog->save();

        // Redirect the user after creating the post
        return redirect('/blogs')->with('success', 'Blog post created successfully!');
    }

    // Show the list of blog posts
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get(); // Fetch posts in descending order by creation time
        return view('blog-posts', ['blogs' => $blogs]);
    }

    public function delete(Blog $blog)
    {
        // Check if the authenticated user is the owner of the blog post
        if (auth()->user()->id === $blog->user_id) {
            $blog->delete();
            return redirect('/blogs')->with('success', 'Blog post deleted successfully!');
        } else {
            // Unauthorized attempt to delete
            return redirect('/blogs')->with('error', 'Unauthorized action!');
        }
    }

}

