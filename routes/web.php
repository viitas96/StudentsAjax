<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StudentController::class, 'index']);

Route::get('/student', [StudentController::class, 'index']);

Route::post('/add-student', [StudentController::class, 'addStudent'])->name('student.add');

Route::get('/student/{id}', [StudentController::class, 'getStudentById']);

Route::put('update-student', [StudentController::class, 'updateStudent'])->name('student.update');

Route::delete('destroy-student/{id}', [StudentController::class, 'deleteStudent']);
