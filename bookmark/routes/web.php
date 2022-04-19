<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\TestController;

if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);
    Route::any('/practice/{n?}', [PracticeController::class, 'index']);
}

Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);

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

    /**
     * List
     */
    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug}/save', [ListController::class, 'save']);
    Route::put('/list/{slug}/update', [ListController::class, 'update']);
    Route::delete('/list/{slug}/destroy', [ListController::class, 'destroy']);
});