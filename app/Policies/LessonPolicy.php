<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use App\Models\Instructor;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lesson $lesson): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Instructor $instructor, Course $course): Response
    {
        return $instructor->id === $course->instructor_id ? 
            new Response(true, 200) : 
            new Response(false, 'nein', 403);
    }

    /**
     * Determine whether the instructor can update the lesson.
     */
    public function update(Instructor $instructor, Lesson $lesson): Response
    {
        return $instructor->id === $lesson->course->instructor_id ? 
        new Response(true, 200) : 
        new Response(false, 'nein', 403);
    }

    /**
     * Determine whether the instructor can delete the lesson.
     */
    public function delete(Instructor $instructor, Lesson $lesson): bool
    {
        return $instructor->id === $lesson->course->instructor_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lesson $lesson): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return false;
    }
}
