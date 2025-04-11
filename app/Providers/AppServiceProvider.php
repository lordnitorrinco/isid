<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\AverageRatingService;
use App\Models\Course;
use App\Policies\CoursePolicy;
use App\Models\Lesson;
use App\Policies\LessonPolicy;
use App\Models\FavoriteCourse;
use App\Policies\FavoriteCoursePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AverageRatingService::class, function ($app) {
            return new AverageRatingService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Lesson::class, LessonPolicy::class);
    }
}
