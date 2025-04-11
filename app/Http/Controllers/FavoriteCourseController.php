<?php

namespace App\Http\Controllers;

use App\Models\FavoriteCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Course;
use Illuminate\Http\Request;

class FavoriteCourseController extends Controller
{
    /**
     * Display a listing of the user's favorite courses.
     */
    public function index()
    {
        $user = Auth::guard('user')->user();

        return response()->json($user->favoriteCourses);
    }

    /**
     * Store a newly created favorite course.
     */
    public function store(Course $course)
    {
        $user = Auth::guard('user')->user();

        $favoriteCourse = FavoriteCourse::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json($favoriteCourse, 201);
    }

    /**
     * Remove the specified favorite course from storage.
     */
    public function destroy(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->input('course_id');

        FavoriteCourse::where('user_id', $userId)->where('course_id', $courseId)->delete();

        return response()->json(null, 204);
    }
}