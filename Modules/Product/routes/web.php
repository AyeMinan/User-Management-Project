<?php

use App\Http\Middleware\MustbeAuthUser;
use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\ProductController;

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

Route::middleware([ MustbeAuthUser::class])->group(function ()  {
    Route::resource('product', ProductController::class)->names('product');
});
