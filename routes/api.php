<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/courses',[CourseController::class,'index']);

Route::get('/courses/{id}',[CourseController::class,'store']);

Route::get('/courses/{id}/modules',[ModuleController::class,'index']);


Route::get('/', function(){

    return response()->json([
        'success' => true,
    ]);

});

