<?php
use App\Http\Controllers\postgre\DepartamentosController;
use Illuminate\Support\Facades\Route;

Route::controller(DepartamentosController::class)->group(function(){
    Route::post('/getAll', 'getAllDepartamentos');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createDepartamento');
    Route::post('/update', 'updatedDepartamento');
    Route::post('/delete', 'deleteDepartamento');
});