<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\UserCourseResource;
use App\Models\UserCourse;

class UserCourseService
{
   
    public function createUserCourse(Request $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id(); 
        $userCourse = UserCourse::create($validatedData);
        return new UserCourseResource($userCourse);
    }

    public function removeCourse(UserCourse $userCourse)
    {
        $userCourse->delete();
        return response()->json(['message' => 'Course deleted successfully.'], 200);
    }

    public function updateUserCourse(Request $request, UserCourse $userCourse)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id(); 
        $userCourse->update($validatedData);
        return new UserCourseResource($userCourse);
    }

   
}