<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $instructor = Auth::guard('instructor')->user();

        if (!$instructor) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $course = Course::create([
            'instructor_id' => $instructor->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course->load(['user', 'lessons', 'ratings', 'comments']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        Auth::shouldUse('instructor');
        Gate::authorize('update', $course);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string'
        ]);

        $course->update($request->only('title', 'description'));

        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        Auth::shouldUse('instructor');
        Gate::authorize('delete', $course);

        $course->delete();

        return response()->json(null, 204);
    }

    /**
     * Display a listing of the instructor's courses.
     */
    public function indexInstructor()
    {
        $instructor = Auth::guard('instructor')->user();

        if (!$instructor) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return Course::where('instructor_id', $instructor->id)->get();
    }

}
