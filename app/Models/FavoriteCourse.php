<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteCourse extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'course_id'];

    /**
     * Get the user that owns the favorite course.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that is marked as favorite.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
