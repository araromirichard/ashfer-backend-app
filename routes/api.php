<?php

use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('articles', [ArticlesController::class, 'index']);
Route::get('articles/{article:slug}', [ArticlesController::class, 'show']);
Route::post('contact-us', [ContactController::class, 'store']);