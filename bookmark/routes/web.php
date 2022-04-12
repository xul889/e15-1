<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);
Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/search', [BookController::class, 'search']);

    # Make sure the create route comes before the `/books/{slug}` route so it takes precedence
    Route::get('/books/create', [BookController::class, 'create']);

    # Note the use of the post method in this route
    Route::post('/books', [BookController::class, 'store']);

    Route::get('/books/{slug}', [BookController::class, 'show']);
    Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

    # Show the form to edit a specific book
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);

    # Process the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']);

    # Show the page to confirm deletion of a book
    Route::get('/books/{slug}/delete', [BookController::class, 'delete']);

    # Process the deletion of a book
    Route::delete('/books/{slug}', [BookController::class, 'destroy']);

    Route::get('/list', [ListController::class, 'show']);
});