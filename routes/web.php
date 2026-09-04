<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::prefix('todo/')->group(function () {
    Route::get('/', [TodoController::class, 'todo_list_form'])->name('todo_list_form');
    Route::post('/', [TodoController::class, 'todo_list_create'])->name('todo_list_create_form');
    Route::delete('/{id}', [TodoController::class, 'todo_list_delete',])->name('todo_list_delete');


});
