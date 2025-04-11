<?php

namespace App\Services;

use App\Models\Course;

class AverageRatingService
{
    public function calculateAverageRatings()
    {
        return Course::with('ratings')
            ->get(['id', 'title'])
            ->map(function ($course) {
                $course->avg_rating = $course->ratings->avg('rating');
                return $course;
            });
    }
}