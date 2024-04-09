<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'loginPage'])->name('loginPage');


Route::group(['middleware' => 'auth:web'], function () {
    // Your protected routes here
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/getdata', [StudentController::class, 'getData'])->name('students.getData');

    Route::delete('students/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::get('students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('students/update/{id}', [StudentController::class, 'update'])->name('students.update');


});

Route::get('/loginpage', [UserController::class, 'loginPage'])->name('loginPage');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/register', [UserController::class, 'register'])->name('register');




