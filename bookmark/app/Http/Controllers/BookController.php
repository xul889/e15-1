<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        # TODO: Query DB for all books
        # Return a view showing all books
        return 'Showing all books...';
    }

    public function show($title)
    {
        # TODO: Query the database for the book where title = $title
        # Return view to display the book data
        return 'This is the details for the book:' . $title;
    }

    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories:' . $category . ' , ' . $subcategory;
    }
}
