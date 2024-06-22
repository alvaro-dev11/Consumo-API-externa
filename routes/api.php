<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::get('users/{user}/posts', [PostController::class, 'filteringResources']);

Route::get('comments/posts/{post}', [PostController::class, 'listingNestedResources']);
