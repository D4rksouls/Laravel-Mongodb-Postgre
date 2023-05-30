<?php
use App\Http\Controllers\postgre\AreasController;
use Illuminate\Support\Facades\Route;

Route::controller(AreasController::class)->group(function(){
    Route::post('/getAll', 'getAllAreas');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createArea');
    Route::post('/update', 'updatedArea');
    Route::post('/delete', 'deleteArea');
});