<?php

namespace App\Services;

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

    public function createCourse(Request $request)
    {
        $validatedData = $request->validated();
        $imagePath = $this->imageService->uploadImage($request, 'image', 'public/courses');
        if ($imagePath) {
            $validatedData['image_path'] = $imagePath;
        }

       return Course::create($validatedData);
    }

    public function updateCourse(Request $request, Course $course)
    {
        $validatedData = $request->validated();
        $imagePath = $this->imageService->uploadImage($request, 'image', 'public/courses');
        if ($imagePath) {
            $validatedData['image_path'] = $imagePath;
        }

        $course->update($validatedData);
        return $course;
    }
}