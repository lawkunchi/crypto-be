<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }

    public function userCourses()
    {
        return $this->belongsToMany(UserCourse::class, 'user_courses');
    }


    /**
     * Check if the current user is registered to the course.
     *
     * @param int|null $userId User ID to check. Defaults to the currently authenticated user.
     * @return bool
     */
    public function isUserRegistered($userId = null)
    {
        $userId = $userId ?: auth()->id();

        return $this->users()->where('users.id', $userId)->exists();
    }
}
