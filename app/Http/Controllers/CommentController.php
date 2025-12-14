<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string',
            'guest_name' => 'sometimes|string|max:255',
        ]);

        // Find the commentable model
        $commentable = $request->commentable_type::findOrFail($request->commentable_id);

        $commentable->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'guest_name' => Auth::check() ? null : $request->guest_name,
        ]);

        return back()->with('success', 'Comment posted successfully. It will be visible after approval.');
    }
}
