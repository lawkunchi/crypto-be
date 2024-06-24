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
    public function register(UserCourseStoreRequest $request): UserCourseResource | JsonResponse
    {

        try {
            $course = Course::findOrFail($request->course_id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Course not found.'], 404);
        }

        if (Gate::denies('alreadyHasCourse', $course)) {
            return response()->json(['message' => 'You already registered to this course'], 403);
        }
        return $this->userCourseService->createUserCourse($request);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  UserCourse  $userCourse
     * @return Response|JsonResponse
     */
    public function unRegister(UserCourse $userCourse):  Response|JsonResponse
    {
        if (!$userCourse->course->isUserRegistered()) {
            return response()->json(['message' => 'You are not registered to this course'], 403);
        }
        return $this->userCourseService->removeCourse($userCourse);
    }

}
