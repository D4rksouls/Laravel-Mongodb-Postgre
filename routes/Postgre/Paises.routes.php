<?php
use App\Http\Controllers\postgre\PaisesController;
use Illuminate\Support\Facades\Route;

Route::controller(PaisesController::class)->group(function(){
    Route::post('/getAll', 'getAllPaises');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createPais');
    Route::post('/update', 'updatedPais');
    Route::post('/delete', 'deletePais');
});