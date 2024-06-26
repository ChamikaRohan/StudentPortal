<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/get-students', [StudentController::class, 'index']);
Route::post('/create-student', [StudentController::class, 'store']);
Route::delete('/delete-student/{id}', [StudentController::class, 'destroy']);