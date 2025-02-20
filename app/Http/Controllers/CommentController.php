<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully!',
            'comment' => $comment
        ]);
    }

    public function fetch($post_id)
    {
        $comments = Comment::where('post_id', $post_id)
            ->whereNull('parent_id')
            ->with('replies')
            ->get();

        return response()->json($comments);
    }
}
