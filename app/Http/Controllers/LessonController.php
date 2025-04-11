<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $lessons = $course->lessons()->get();
        return response()->json($lessons);
    }

    /**
     * Display a listing of the lessons for a specific course.
     */
    public function indexByCourse($courseId)
    {
        $lessons = Lesson::where('course_id', $courseId)->get();
        return response()->json($lessons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        Auth::shouldUse('instructor');
        Gate::authorize('update', $course);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        $validated['course_id'] = $course->id;

        $lesson = Lesson::create($validated);

        return response()->json($lesson, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        return response()->json($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        Auth::shouldUse('instructor');
        Gate::authorize('update', $lesson);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'video_url' => 'sometimes|required|url',
        ]);

        $lesson->update($validated);

        return response()->json($lesson);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        Auth::shouldUse('instructor');
        Gate::authorize('delete', $lesson);

        $lesson->delete();

        return response()->json(null, 204);
    }
}
