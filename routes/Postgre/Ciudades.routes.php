<?php
use App\Http\Controllers\postgre\CiudadesController;
use Illuminate\Support\Facades\Route;

Route::controller(CiudadesController::class)->group(function(){
    Route::post('/getAll', 'getAllCiudades');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createCiudad');
    Route::post('/update', 'updatedCiudad');
    Route::post('/delete', 'deleteCiudad');
});