<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('todo', TodoController::class);

Route::post('/postannouncement/', [AnnouncementsController::class, 'store'])->middleware('checkrequest');

Route::get('/displayannouncements', [AnnouncementsController::class, 'show'])->middleware('checkrequest');

Route::post('/deletepost/{id}', [AnnouncementsController::class, 'destroy'])->middleware('checkrequest');

Route::post('/postpic/', [AnnouncementsController::class, 'upload'])->middleware('checkrequest');

Route::post('/postnewsfeed', [NewsfeedController::class, 'store'])->middleware('checkrequest');

Route::get('/displaynewsfeed', [NewsfeedController::class, 'show'])->middleware('checkrequest');

Route::get('/deletenewsfeed/{id}', [NewsfeedController::class, 'destroy'])->middleware('checkrequest');

Route::post('/enrollstudent', [StudentsController::class, 'store'])->middleware('checkrequest');

Route::get('/displaystudents', [StudentsController::class, 'show'])->middleware('checkrequest');

Route::post('/filterstudents', [StudentsController::class, 'filter'])->middleware('checkrequest');

Route::post('searchstudent/search', [StudentsController::class, 'search'])->middleware('checkrequest');

Route::post('/addcourse', [CoursesController::class, 'store'])->middleware('checkrequest');

Route::get('/displaycourses', [CoursesController::class, 'show'])->middleware('checkrequest');

Route::post('/addteachers', [TeachersController::class, 'store'])->middleware('checkrequest');

Route::get('/displayteachers', [TeachersController::class, 'show'])->middleware('checkrequest');