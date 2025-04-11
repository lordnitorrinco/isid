<?php

namespace App\Policies;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RatingPolicy
{
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
    public function view(User $user, Rating $rating): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the rating.
     */
    public function update(User $user, Rating $rating): Response
    {
        return $user->id === $rating->user_id
            ? Response::allow()
            : Response::deny('You do not own this rating.');
    }

    /**
     * Determine whether the user can delete the rating.
     */
    public function delete(User $user, Rating $rating): Response
    {
        return $user->id === $rating->user_id
            ? Response::allow()
            : Response::deny('You do not own this rating.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rating $rating): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rating $rating): bool
    {
        return false;
    }
}
