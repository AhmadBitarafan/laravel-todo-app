<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::resource('todos',TodoController::class);

Route::prefix('todos/')->name('todos.')->group(function () {
        Route::get('trashed/list', [TodoController::class, 'trashed_list'])->name('trashed');
        Route::patch('restore/{id}', [TodoController::class, 'restore'])->name('trashed.restore');
        Route::delete('force/{id}', [TodoController::class, 'force_delete'])->name('trashed.forceDelete');
        Route::get('pending/list', [TodoController::class, 'pending'])->name('pending');
        Route::get('completed/list', [TodoController::class, 'completed'])->name('completed');
});
