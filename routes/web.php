<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/user/{uuid}/{code}', [UserController::class, 'showForm'])->name("user.form");
    Route::get('/user-by-code', [UserController::class, 'getUserId']);
    Route::get('/user-get/{uuid}/{code}', [UserController::class, 'getUser'])->name('user.show');
    Route::get('/user/edit/{uuid}/{code}', [UserController::class, 'editIndex'])->name('user.edit')->middleware(App\Http\Middleware\Master::class);
    Route::post('/user/{uuid}/{code}', [UserController::class, 'store'])->name('user.add');;
    Route::get('/', [UserController::class,'index']);
});
Route::post('/admin/login', [RegisterController::class,'login']);
Route::get('/login', [RegisterController::class,'getLoginIndex'])->name("login");


// Route::get("/users", )
