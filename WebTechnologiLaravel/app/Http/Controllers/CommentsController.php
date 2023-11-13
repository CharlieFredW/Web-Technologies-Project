<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'blogId' => 'required|exists:blogs,id',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new comment
        $comment = new Comment();
        // Set the blog_id based on the request
        $comment->blog_id = $request->input('blogId');
        // Set the user_id based on the currently authenticated user
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $comment->save();

        // Return a JSON response with the new comment
        return response()->json(['comment' => $comment->comment], 201);
    }
    public function getComments($blogId)
    {
        // Replace the following line with your logic to fetch comments for the given $blogId
        $comments = Comment::where('blog_id', $blogId)->get();
        $comments = Comment::with('user')->where('blog_id', $blogId)->get();
        return response()->json(['comments' => $comments]);

    }
}
