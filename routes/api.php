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
use App\Http\Controllers\Api\ContentController;
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
    Route::post('user/unique-info', [UserController::class, 'checkUniqeInfo']);
//    Route::post('user/email', [UserController::class, 'checkUserEmailExist']);

    Route::apiResource('roles',RoleController::class);
    Route::post('role/status/{id}',[RoleController::class,'changeItemStatus']);
    Route::post('role/unique-info', [RoleController::class, 'checkUniqeInfo']);

    Route::apiResource('permissions',PermissionController::class);
    Route::post('permission/unique-info', [PermissionController::class, 'checkUniqeInfo']);

    Route::apiResource('services',ServiceController::class);
    Route::post('service/status/{id}',[ServiceController::class,'changeItemStatus']);
    Route::post('service/unique-info', [ServiceController::class, 'checkUniqeInfo']);

    Route::apiResource('events',EventController::class);
    Route::post('event/status/{id}',[EventController::class,'changeItemStatus']);
    Route::post('event/unique-info', [EventController::class, 'checkUniqeInfo']);

    Route::apiResource('causes',CauseController::class);
    Route::post('cause/status/{id}',[CauseController::class,'changeItemStatus']);
    Route::post('cause/unique-info', [CauseController::class, 'checkUniqeInfo']);

    Route::apiResource('galleries',GalleryController::class);
    Route::post('gallery/status/{id}',[GalleryController::class,'changeItemStatus']);
    Route::post('gallery/unique-info', [GalleryController::class, 'checkUniqeInfo']);

    Route::apiResource('faqs',FaqController::class);
    Route::post('faq/status/{id}',[FaqController::class,'changeItemStatus']);
    Route::post('faq/unique-info', [FaqController::class, 'checkUniqeInfo']);

    Route::apiResource('contacts',ContactController::class);
    Route::post('contact/status/{id}',[ContactController::class,'changeItemStatus']);

    Route::apiResource('abouts',AboutController::class);
    Route::post('about/status/{id}',[AboutController::class,'changeItemStatus']);
    Route::post('about/unique-info', [AboutController::class, 'checkUniqeInfo']);

    Route::apiResource('contents',ContentController::class);

    Route::post('user/logout', [UserController::class, 'logout']);

});




Route::post('login', AuthController::class);
