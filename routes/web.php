<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/get-students', [StudentController::class, 'index']);
Route::post('/create-student', [StudentController::class, 'store']);
