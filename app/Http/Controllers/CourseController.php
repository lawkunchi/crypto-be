<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Resources\CourseResource;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\CourseIndexRequest;
use Illuminate\Support\Facades\Gate;
use App\Services\CourseManagementService;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Js;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    private $courseService;

    public function __construct(CourseManagementService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display the course add view.
     */
    public function add(): Response
    {
        return Inertia::render('Course/AddCourse');
    }
    

    /**
     * Display the course add view.
     */
    public function edit(Course $course): Response
    {
        return Inertia::render('Course/EditCourse', [
            'course' => $course
        ]);
    }
    

    /**
     * Display a listing of the courses.
     *
     */
    public function list(CourseIndexRequest $request)
    {
        $courses = Course::all();
        return Inertia::render('Course/CourseList', [
            'courses' => $courses
        ]);
    }


     /**
     * Display a listing of the courses.
     *
     */
    public function view(Course $course)
    {
        $course->count = $course->users->count();
        return Inertia::render('Course/CourseDetails', [
            'course' => $course
        ]);
    }

    /**
     * Display a listing of the courses.
     *
     * @param CourseIndexRequest  $request
     * @return JsonResource
     */
    public function index(CourseIndexRequest $request): JsonResource
    {
        $limit = $request->input('limit', 10);
        $courses = Course::paginate($limit);
        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  StoreCourseRequest  $request
     * @return CourseResource
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $this->courseService->createCourse($request);
        return redirect(route('course.list' ))->with('message','Course created successfully!');

    }


    /**
     * Update the specified course in storage.
     *
     * @param  updateCourseRequest  $request
     * @param  Course  $course
     * @return CourseResource
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $this->courseService->updateCourse($request, $course);
        return back()->with('message', 'Course update successfully!');
    }

    /**
     * Display the specified course.
     *
     * @param  Course  $course
     * @return CourseResource
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Delete the specified course.
     *
     * @param  Course  $course
     * @return JsonResponse
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('message', 'Course deleted successfully!');
    }
}
