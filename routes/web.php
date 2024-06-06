<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:admin'])->group(function () {
    Route::get('/user/{uuid}/{code}', [UserController::class, 'showForm']);
    Route::get('/user-get/{uuid}/{code}', [UserController::class, 'getUser'])->name('user.show');
    Route::get('/user/edit/{uuid}/{code}', [UserController::class, 'editIndex'])->name('user.edit');
    Route::post('/user/{uuid}/{code}', [UserController::class, 'store'])->name('user.add');;
    Route::get('/', [UserController::class,'index']);
// });
Route::get('/login', [UserController::class,'index'])->name("login");


// Route::get("/users", )
