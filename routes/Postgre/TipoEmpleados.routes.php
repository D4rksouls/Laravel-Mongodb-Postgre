<?php
use App\Http\Controllers\postgre\TipoEmpleadosController;
use Illuminate\Support\Facades\Route;

Route::controller(TipoEmpleadosController::class)->group(function(){
    Route::post('/getAll', 'getAllTipoEmpleados');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createTipoEmpleado');
    Route::post('/update', 'updatedTipoEmpleado');
    Route::post('/delete', 'deleteTipoEmpleado');
});