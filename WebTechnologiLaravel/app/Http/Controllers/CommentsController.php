<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;



class CommentsController extends Controller
{
    //Function to store
    public function store(Request $request)
    {
        // Log the authenticated user information
        logger()->info('User ID: ' . Auth::id());
        logger()->info('User: ' . print_r(Auth::user(), true));

        // Validate the requested data
        $validator = Validator::make($request->all(), [
            'blogId' => 'required|exists:blogs,id',
            'comment' => 'required|string',
        ]);

        //If not validated then give error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new comment in the comments section
        $comment = new Comment();
        // Set the blog_id based on the request
        $comment->blog_id = $request->input('blogId');
        // Set the user_id based on the currently authenticated user
        $comment->user_id = Auth::id();
        $comment->comment = $request->input('comment');
        $comment->save();

        // Return a JSON response with the newly created comment
        return response()->json(['user' => Auth::user(), 'comment' => $comment->comment], 201);
    }


    //Function to get the comments
    public function getComments($blogId)
    {
        //Authenticate
        $comments = Comment::with('user')->where('blog_id', $blogId)->get();
        $userIsOwner = Auth::check();

        // Add the is_owner attribute to the user information in each comment
        foreach ($comments as $comment) {
            $comment->user->is_owner = $userIsOwner && ($comment->user_id === Auth::id());
        }

        //Return the response
        return response()->json(['comments' => $comments, 'userIsOwner' => $userIsOwner]);
    }

    //Function to update a comment
    public function update(Request $request, Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (!$comment->isOwner()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validate the requested data
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);

        //Return fail if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Update the comment content
        $comment->comment = $request->input('comment');
        $comment->save();

        // Return a JSON response with the updated comment
        return response()->json(['comment' => $comment->comment], 200);
    }


    //Function to delete comment
    public function destroy(Comment $comment)
    {
        // Ensure that the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if the authenticated user is the owner of the comment
        if (Auth::user()->id !== $comment->user_id) {
            return response()->json(['error' => 'Permission denied'], 403);
        }

        // Delete the comment
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
