<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard/courses/{id}', function ($id) {
    return Inertia::render('CourseDetail', ['courseId' => $id]);
})->middleware(['auth', 'verified'])->name('course.detail');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/course/edit/{course}', [CourseController::class, 'edit'])
    ->name('course.edit');

Route::get('/course/add', [CourseController::class, 'add'])
    ->name('course.add');


Route::get('/dashboard/courses', [CourseController::class, 'list'])
    ->name('course.list');

Route::delete('/course/{course}', [CourseController::class, 'destroy'])
    ->name('course.delete');

    Route::get('/course/{course}', [CourseController::class, 'view'])
    ->name('course.view');

Route::post('/course', [CourseController::class, 'store'])
    ->name('course.store');

    Route::patch('/course/{course}', [CourseController::class, 'update'])
    ->name('course.update');

require __DIR__ . '/auth.php';
