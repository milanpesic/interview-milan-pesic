<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

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

Route::get('/api', function () {
    return view('welcome');
});


#Route::resource('api/todo', ToDoController::class);

Route::get('api/todo/show', [ToDoController::class, 'showToDoList']);
Route::post('api/todo/create', [ToDoController::class, 'createToDoList']);
Route::post('api/todo/checked/{id}', [ToDoController::class, 'checkedToDoList']);
Route::post('api/todo/update/{id}', [ToDoController::class, 'updateToDoList']);
Route::post('api/todo/delete/{id}', [ToDoController::class, 'deleteToDoList']);