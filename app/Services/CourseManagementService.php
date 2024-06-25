<?php

namespace App\Services;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;

class CourseManagementService
{
    protected $imageService;

    public function __construct(ImageUploadService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function createCourse(StoreCourseRequest $request)
    {
        $imagePath = $this->imageService->uploadImage($request);
        $course = new Course();
        $course->name = $request->name;
        $course->image = $imagePath;
        $course->save();
        return $course;
    }

    public function updateCourse(UpdateCourseRequest $request, Course $course)
    {
        $course->name = $request->name;
        $imagePath = $this->imageService->uploadImage($request);
        if($imagePath) {
            $course->image = $imagePath;
        }
        $course->save();
        return $course;
    }
}