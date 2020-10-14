<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});



Route::post('/login',[AccountController::class, 'login'])->middleware("checking");

Route::post('/logout',[AccountController::class, 'logout'])->middleware("checkrequest");

Route::get('/checksession', [AccountController::class, 'home'])->middleware("checkrequest");


Route::get('{any}', function () {

    return view('welcome');

})->middleware("checking");