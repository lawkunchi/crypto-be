<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\UserCourseResource;
use App\Models\UserCourse;

class UserCourseService
{
   
    public function createUserCourse(Course $course)
    {
        $userCourse = new UserCourse();
        $userCourse->user_id = auth()->id();
        $userCourse->course_id = $course->id;
        $userCourse->save();
        return new UserCourseResource($userCourse);
    }

    public function removeCourse(Course $course)
    {
        $userCourse = UserCourse::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();
        $userCourse->forceDelete();
        return response()->json(['message' => 'Course deleted successfully.'], 200);
    }
   
}