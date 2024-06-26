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
// PR EDIT ROUTES ASSETS -- clear
// BREAK ISYA


Route::get('/criterias', [CriteriaController::class, 'index']);
Route::get('/criteria/create', [CriteriaController::class, 'create']);
Route::post('/criteria/store', [CriteriaController::class, 'store']);
Route::get('/criteria/edit/{id}', [CriteriaController::class, 'edit']);
Route::post('/criteria/update/{id}', [CriteriaController::class, 'update']);

Route::get('/foods', [FoodController::class, 'index']);
Route::get('/food/edit/{id}', [FoodController::class, 'edit']);
Route::post('/food/update/{id}', [FoodController::class, 'update']);
Route::get('/food/create', [FoodController::class, 'create']);
Route::post('/food/store', [FoodController::class, 'store']);
Route::post('/food/delete/{id}', [FoodController::class, 'destroy']);
Route::get('/food/calculateSAW', [FoodController::class, 'calculateSAW']);


Route::get('/calculate-saw-fake', [FoodController::class, 'calculateSAWWithFakeData']);


Route::get('/calculate-saw', [SAWController::class, 'calculateSAW'])->name('calculate-saw');
Route::get('/calc', [SAWController::class, 'index'])->name('calculate-saw');