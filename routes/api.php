<?php

use App\Http\Controllers\Api\DisciplineController;
use App\Http\Controllers\Api\LaboratoryWorkController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\RatedController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request){
        return $request->user();
    });

});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);





//Route::get('/disciplines', [DisciplineController::class, 'index']);


Route::apiResources([
    'rateds'=>RatedController::class,
    'laboratory_works'=>LaboratoryWorkController::class,
    'lessons'=>LessonController::class,
    
]);

Route::get('/lessonsdate', [RatedController::class, 'getLessonData']);