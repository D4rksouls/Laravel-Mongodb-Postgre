<?php
use App\Http\Controllers\postgre\FacultadesController;
use Illuminate\Support\Facades\Route;

Route::controller(FacultadesController::class)->group(function(){
    Route::post('/getAll', 'getAllFacultades');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createFacultad');
    Route::post('/update', 'updatedFacultad');
    Route::post('/delete', 'deleteFacultad');
});