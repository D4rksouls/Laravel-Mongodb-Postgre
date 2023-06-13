<?php
use App\Http\Controllers\Mongodb\MongodbController;
use Illuminate\Support\Facades\Route;

Route::controller(MongodbController::class)->group(function(){
    Route::post('/getAll', 'show');
    Route::post('/getBytitle', 'findbyTitle');
    Route::post('/create', 'mongo');
    Route::post('/showPostgre', 'showPostgre');
    Route::post('/update', 'updated');
    Route::post('/delete', 'delete');
});