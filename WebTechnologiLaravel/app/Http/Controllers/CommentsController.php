<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth; // Import the Auth facade



class CommentsController extends Controller
{
    public function store(Request $request)
    {
        // Log the authenticated user information
        logger()->info('User ID: ' . Auth::id());
        logger()->info('User: ' . print_r(Auth::user(), true));

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
        return response()->json(['user' => Auth::user(), 'comment' => $comment->comment], 201);
    }

    public function getComments($blogId)
    {
        $comments = Comment::with('user')->where('blog_id', $blogId)->get();
        $userIsOwner = Auth::check();

        // Add the is_owner attribute to the user information in each comment
        foreach ($comments as $comment) {
            $comment->user->is_owner = $userIsOwner && ($comment->user_id === Auth::id());
        }

        return response()->json(['comments' => $comments, 'userIsOwner' => $userIsOwner]);
    }

    public function update(Request $request, Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (!$comment->isOwner()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the comment content
        $comment->comment = $request->input('comment');
        $comment->save();

        // Return a JSON response with the updated comment
        return response()->json(['comment' => $comment->comment], 200);
    }
}
