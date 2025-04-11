<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\AverageRatingService;

class RatingController extends Controller
{
    protected $averageRatingService;

    public function __construct(AverageRatingService $averageRatingService)
    {
        $this->averageRatingService = $averageRatingService;
    }

    /**
     * Display average ratings for all courses.
     */
    public function averageRatings()
    {
        $averageRatings = $this->averageRatingService->calculateAverageRatings();
        return response()->json($averageRatings);
    }

    /**
     * Display a listing of ratings for a specific course.
     */
    public function index(Course $course)
    {
        $ratings = $course->load('ratings');
        return response()->json($ratings->ratings);
    }

    /**
     * Store a newly created rating for a course.
     */
    public function store(Request $request, Course $course)
    {
        Auth::shouldUse('user');

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $validated['course_id'] = $course->id;
        $validated['user_id'] = Auth::id();

        $rating = Rating::create($validated);

        return response()->json($rating, 201);
    }

    /**
     * Update the specified rating.
     */
    public function update(Request $request, Rating $rating)
    {
        Auth::shouldUse('user');
        Gate::authorize('update', $rating);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating->update($validated);

        return response()->json($rating);
    }

    /**
     * Remove the specified rating from storage.
     */
    public function destroy(Rating $rating)
    {
        Auth::shouldUse('user');
        Gate::authorize('delete', $rating);

        $rating->delete();

        return response()->json(null, 204);
    }
}
