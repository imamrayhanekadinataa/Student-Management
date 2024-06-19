<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/data', [StudentController::class, 'getStudents']);
Route::post('/students', [StudentController::class, 'store']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);


Route::get('/', function () {
    return view('welcome');
});
