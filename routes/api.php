<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});
Route::group(['middleware' => 'auth:sanctum'], function() {

  Route::group(['prefix' => 'course'], function () {
      Route::get('', [CourseController::class, 'index']);
      Route::get('/{course}', [CourseController::class, 'show']);
      Route::post('/register  ', [UserCourseController::class, 'register']);
      Route::get('/unregister/{userCourse}', [UserCourseController::class, 'unregister']);
  });

});