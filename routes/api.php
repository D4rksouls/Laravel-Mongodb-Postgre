<?php

use Illuminate\Http\Request;
use App\Http\Controllers\mongodb\MongodbController;
use App\Http\Controllers\postgre\ContratacionController;
use App\Http\Controllers\postgre\SedesController;
use Illuminate\Support\Facades\Route;

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

Route::controller(MongodbController::class)->group(function(){
    Route::post('/evento', 'mongo');
});

Route::controller(ContratacionController::class)->group(function(){
    Route::post('/contratacion', 'postgre');
});