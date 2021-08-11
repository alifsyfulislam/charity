<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CauseController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->group(function(){

    Route::apiResource('users',UserController::class);
    Route::post('user/status/{id}',[UserController::class,'changeItemStatus']);

    Route::apiResource('roles',RoleController::class);
    Route::post('role/status/{id}',[RoleController::class,'changeItemStatus']);

    Route::apiResource('permissions',PermissionController::class);

    Route::apiResource('services',ServiceController::class);
    Route::post('service/status/{id}',[ServiceController::class,'changeItemStatus']);

    Route::apiResource('events',EventController::class);
    Route::post('event/status/{id}',[EventController::class,'changeItemStatus']);

    Route::apiResource('causes',CauseController::class);
    Route::post('cause/status/{id}',[CauseController::class,'changeItemStatus']);

    Route::apiResource('galleries',GalleryController::class);
    Route::post('gallery/status/{id}',[GalleryController::class,'changeItemStatus']);

    Route::apiResource('faqs',FaqController::class);
    Route::post('faq/status/{id}',[FaqController::class,'changeItemStatus']);

    Route::apiResource('contacts',ContactController::class);
    Route::post('contact/status/{id}',[ContactController::class,'changeItemStatus']);

    Route::apiResource('abouts',AboutController::class);
    Route::post('about/status/{id}',[AboutController::class,'changeItemStatus']);

});




Route::post('login', AuthController::class);