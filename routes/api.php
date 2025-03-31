<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\NewsletterController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/featured', [ProjectController::class, 'featured']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
Route::get('/projects/language/{language}', [ProjectController::class, 'byLanguage']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/recent', [ArticleController::class, 'recent']);
Route::get('/articles/category/{category}', [ArticleController::class, 'byCategory']);
Route::get('/articles/{slug}', [ArticleController::class, 'show']);

// Routes pour Works
Route::get('/works', [WorkController::class, 'index']);
Route::get('/works/featured', [WorkController::class, 'featured']);
Route::get('/works/technology/{technology}', [WorkController::class, 'byTechnology']);
Route::get('/works/technologies', [WorkController::class, 'getTechnologies']);
Route::get('/works/years', [WorkController::class, 'getYears']);
Route::get('/works/{slug}', [WorkController::class, 'show']);

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);
Route::get('/newsletter/verify/{token}', [NewsletterController::class, 'verify']);
