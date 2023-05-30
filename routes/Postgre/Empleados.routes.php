<?php
use App\Http\Controllers\postgre\EmpleadosController;
use Illuminate\Support\Facades\Route;

Route::controller(EmpleadosController::class)->group(function(){
    Route::post('/getAll', 'getAllEmpleados');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createEmpleado');
    Route::post('/update', 'updatedEmpleado');
    Route::post('/delete', 'updatedEmpleado');
});