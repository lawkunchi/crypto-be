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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CourseController::class)->group(function () {
        Route::get('/course/edit/{course}', 'edit')->name('course.edit');
        Route::get('/course/add', 'add')->name('course.add');
        Route::get('/dashboard/courses', 'list')->name('course.list');
        Route::delete('/course/{course}', 'destroy')->name('course.delete');
        Route::get('/course/{course}', 'view')->name('course.view');
        Route::post('/course', 'store')->name('course.store');
        Route::post('/course/{course}', 'update')->name('course.update');
    });
});

require __DIR__ . '/auth.php';
