<?php
use App\Http\Controllers\postgre\ContratacionController;
use Illuminate\Support\Facades\Route;

Route::controller(ContratacionController::class)->group(function(){
    Route::post('/getAll', 'getAllContrataciones');
    Route::post('/getById', 'findById');
    Route::post('/create', 'createContratacion');
    Route::post('/update', 'updatedContratacion');
    Route::post('/delete', 'deleteTipoContratacion');
});