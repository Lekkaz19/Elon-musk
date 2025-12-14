<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with(['user', 'commentable'])->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate(['content' => 'required|string']);
        $comment->update(['content' => $request->content]);
        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Toggle the approval status of a comment.
     */
    public function toggleApproval(Comment $comment)
    {
        $comment->approved = !$comment->approved;
        $comment->save();

        $status = $comment->approved ? 'approved' : 'un-approved';
        return back()->with('success', "Comment has been successfully {$status}.");
    }
}