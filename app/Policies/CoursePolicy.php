<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use App\Models\Instructor;

class CoursePolicy
{
    /**
     * Determine whether the user or instructor can view any models.
     */
    public function viewAny($userOrInstructor): bool
    {
        return $userOrInstructor instanceof User || $userOrInstructor instanceof Instructor;
    }

    /**
     * Determine whether the user or instructor can view the model.
     */
    public function view($userOrInstructor, Course $course): bool
    {
        return $userOrInstructor instanceof User || ($userOrInstructor instanceof Instructor && $userOrInstructor->id === $course->instructor_id);
    }

    /**
     * Determine whether the instructor can create models.
     */
    public function create(Instructor $instructor): bool
    {
        return true;
    }

    /**
     * Determine whether the instructor can update the model.
     */
    public function update(Instructor $instructor, Course $course): bool
    {
        return $instructor->id === $course->instructor_id;
    }

    /**
     * Determine whether the instructor can delete the model.
     */
    public function delete(Instructor $instructor, Course $course): bool
    {
        return $instructor->id === $course->instructor_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        return false;
    }
}
