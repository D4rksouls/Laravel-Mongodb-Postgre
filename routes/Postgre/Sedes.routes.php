<?php
use App\Http\Controllers\postgre\SedesController;
use Illuminate\Support\Facades\Route;

Route::controller(SedesController::class)->group(function(){
    Route::post('/getAll', 'getAllSedes');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createSede');
    Route::post('/update', 'updatedSede');
    Route::post('/delete', 'deleteSede');
});