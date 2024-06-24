<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueUserCourse implements Rule
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function passes($attribute, $value)
    {
        // Check if the user already has the course
        $exists = DB::table('user_courses')
                    ->where('user_id', $this->userId)
                    ->where('course_id', $value)
                    ->exists();

        return $exists;
    }

    public function message()
    {
        return 'The user already has this course.';
    }
}