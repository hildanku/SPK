<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CalculateController;
use App\Http\Controllers\SAWController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'dashboard');
Route::controller(CriteriaController::class)->group(function () {
    Route::get('/criterias', 'index');
    Route::get('/criteria/create', 'create');
    Route::post('/criteria/store', 'store');
    Route::get('/criteria/edit/{id}', 'edit');
    Route::post('/criteria/update/{id}', 'update');
});
Route::controller(FoodController::class)->group(function () {
    Route::get('/foods', 'index');
    Route::get('/food/edit/{id}', 'edit');
    Route::post('/food/update/{id}', 'update');
    Route::get('/food/create', 'create');
    Route::post('/food/store', 'store');
    Route::post('/food/delete/{id}', 'destroy');
});

Route::get('/calculate-saw-fake',  'calculateSAWWithFakeData');
Route::get('/calc', [SAWController::class, 'index'])->name('calculate-saw');