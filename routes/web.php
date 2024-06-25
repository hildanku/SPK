<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tes;
use App\Http\Controllers\CriteriaController;
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
Route::get('/', function () {
    return view('welcome');
});

 
Route::get('/tes', [tes::class, 'index']);

Route::get('/criteria', [CriteriaController::class, 'index']);
Route::get('/criteria/edit/{id}', [CriteriaController::class, 'edit']);
Route::post('/criteria/update/{id}', [CriteriaController::class, 'update']);