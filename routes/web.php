<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\MustbeAuthUser;
use App\Http\Middleware\MustbeGuestUser;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([ MustbeAuthUser::class])->group(function () {
    Route::post('/logout', [LogoutController::class,'destroy']);


    Route::get('/role', [RoleController::class, 'show'])->name('main.show') ->middleware('checkRoleViewPermission');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('checkRoleCreatePermission');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store')->middleware('checkRoleCreatePermission');
    Route::get('/role/{role}', [RoleController::class, 'edit'])->name('role.edit')->middleware('checkRoleUpdatePermission');
    Route::post('/role/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('checkRoleUpdatePermission');
    Route::delete('/role/{role}', [RoleController::class, 'delete'])->name('role.delete')->middleware('checkRoleDeletePermission');

    Route::get('/user', [AdminUserController::class, 'index'])->name('main.index')->middleware('checkUserViewPermission');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('user.create')->middleware('checkUserCreatePermission');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('user.store')->middleware('checkUserCreatePermission');
    Route::get('/user/{user}', [AdminUserController::class,'edit'])->name('user.edit')->middleware('checkUserUpdatePermission');
    Route::post('/user/{user}', [AdminUserController::class,'update'])->name('user.update')->middleware('checkUserUpdatePermission');
    Route::delete('/user/{user}', [AdminUserController::class,'delete'])->name('user.delete')->middleware('checkUserDeletePermission');
});

Route::middleware([ MustbeGuestUser::class])->group(function () {
Route::get('/login', [LoginController::class,'create'])->name('login.create');
Route::post('/login', [LoginController::class,'store'])->name('login.store');
Route::get('/register', [RegisterController::class,'create'])->name('register.create');
Route::post('/register', [RegisterController::class,'store'])->name('login.create');
});
