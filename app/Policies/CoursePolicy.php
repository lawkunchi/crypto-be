<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class CoursePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the course.
     */
    public function update(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    /**
     * Determine whether the user can delete the course.
     */
    public function delete(User $user, Course $course): bool
    {
        return $user->id === $course->user_id;
    }

    /**
     * Determine whether the user already has the course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return bool
     */
    public function alreadyHasCourse(User $user, Course $course): bool
    {
        $exists = DB::table('user_courses')
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();
        return !$exists;
    }
}
