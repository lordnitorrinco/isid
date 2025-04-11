<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of comments for a specific course.
     */
    public function index(Course $course)
    {
        $comments = $course->comments()->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created comment for a course.
     */
    public function store(Request $request, Course $course)
    {
        Auth::shouldUse('user');

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $validated['course_id'] = $course->id;
        $validated['user_id'] = Auth::id();

        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        Auth::shouldUse('user');
        Gate::authorize('update', $comment);

        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json($comment);
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        Auth::shouldUse('user');
        Gate::authorize('delete', $comment);

        $comment->delete();

        return response()->json(null, 204);
    }
}
