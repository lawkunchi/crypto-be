<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Resources\UserCourseResource;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\UserCourseStoreRequest;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Gate;
use App\Services\UserCourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserCourseController extends Controller
{
    private $userCourseService;

    public function __construct(UserCourseService $userCourseService)
    {
        $this->userCourseService = $userCourseService;
    }


    /**
     * Store a newly created course in storage.
     *
     * @param  UserCourseStoreRequest  $request
     * @return UserCourseResource
     */
    public function register(Course $course): UserCourseResource | JsonResponse
    {
        if (Gate::denies('alreadyHasCourse', $course)) {
            return response()->json(['message' => 'You already registered to this course'], 403);
        }
        return $this->userCourseService->createUserCourse($course);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  UserCourse  $userCourse
     * @return Response|JsonResponse
     */
    public function unRegister(Course $course):  Response|JsonResponse
    {
        if (!$course->isUserRegistered()) {
            return response()->json(['message' => 'You are not registered to this course'], 403);
        }
        return $this->userCourseService->removeCourse($course);
    }

}
