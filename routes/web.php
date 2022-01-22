<?php

use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\AppealController;
use \App\Http\Middleware\SuggestAppeal;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/news', [NewsController::class, 'getList'])->name('news_list');
Route::get('/news/{slug}', [NewsController::class, 'getDetails'])->name('news_item');

Route::match(['get', 'post'], '/appeal', AppealController::class)->name('appeal')->withoutMiddleware([SuggestAppeal::class]);

Route::match(['get', 'post'], '/registration', [WebAuthController::class, 'registration'])
  ->name('registration');

Route::match(['get', 'post'], '/login', [WebAuthController::class, 'login'])
  ->name('login');

Route::group(['middleware' => 'auth'], function() {
  Route::get('/profile', [WebAuthController::class, 'profile'])->name('profile');
  Route::get('/logout', [WebAuthController::class, 'logout'])->name('logout');
});