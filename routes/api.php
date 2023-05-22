<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SupportController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/**
 * Reset Password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest');


Route::middleware(['auth:sanctum'])->group(function(){
       
    Route::get('/courses', [CourseController::class,'index']);    
    Route::get('/courses/{id}', [CourseController::class,'store']);    
    Route::get('/courses/{id}/modules', [ModuleController::class,'index']);
    
    Route::get('/modules/{id}/lessons', [LessonController::class,'index']);
    Route::get('/lessons/{id}', [LessonController::class,'show']);
    
    Route::get('/my-supports', [SupportController::class,'mySupports']);
    Route::get('/supports', [SupportController::class,'index']);    
    Route::post('/supports', [SupportController::class,'store']);
    
    Route::post('/replies', [SupportController::class,'createReply']);

});



Route::get('/', function(){

    return response()->json([
        'success' => true,
        'endpoint' => true,
    ]);

});

