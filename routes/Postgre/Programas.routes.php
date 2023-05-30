<?php
use App\Http\Controllers\postgre\ProgramasController;
use Illuminate\Support\Facades\Route;

Route::controller(ProgramasController::class)->group(function(){
    Route::post('/getAll', 'getAllProgramas');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createPrograma');
    Route::post('/update', 'updatedPrograma');
    Route::post('/delete', 'deletePrograma');
});