<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        # Get data for authors in alphabetical order by last name
        $authors = Author::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();

        return view('books/create', ['authors' => $authors]);
    }

    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:books,slug,alpha_dash',
            'author_id' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author_id = $request->author ;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/create')->with(['flash-alert' => 'Your book was added']);
    }

    /**
     * GET /search
     * Search the books based on title or author
     */
    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # Note: If validation fails, it will redirect back to `/`

        # Get form data
        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        # Do the search
        $searchResults = Book::where($searchType, 'LIKE', '%'.$searchTerms.'%')->get();
            
        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
            'searchResults' => $searchResults
        ]);
    }

    /**
     * GET /books
     * Show all the books
     */
    public function index()
    {
        $books = Book::orderBy('title', 'ASC')->get();

        //$newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        
        $newBooks = $books->sortByDesc('id')->take(3);

        return view('books/index', [
            'books' => $books,
            'newBooks' => $newBooks
        ]);
    }

    /**
     * GET /books/{slug}
     * Show the details for an individual book
     */
    public function show($slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        return view('books/show', [
            'book' => $book,
        ]);
    }

    /**
    * GET /books/{slug}/edit
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }

        return view('books/edit', ['book' => $book]);
    }

    /**
    * PUT /books
    */
    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:books,slug,' . $book->id . '|alpha_dash',
        'author' => 'required',
        'published_year' => 'required|digits:4',
        'cover_url' => 'url',
        'info_url' => 'url',
        'purchase_url' => 'required|url',
        'description' => 'required|min:255'
    ]);

        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your changes were saved.']);
    }

    /**
    * Asks user to confirm they want to delete the book
    * GET /books/{slug}/delete
    */
    public function delete($slug)
    {
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with([
                'flash-alert' => 'Book not found'
            ]);
        }

        return view('books/delete', ['book' => $book]);
    }

    /**
    * Deletes the book
    * DELETE /books/{slug}/delete
    */
    public function destroy($slug)
    {
        $book = Book::findBySlug($slug);

        #$book->users()->detach();

        $book->delete();

        return redirect('/books')->with([
            'flash-alert' => '“' . $book->title . '” was removed.'
        ]);
    }

    /**
     * GET /books/filter
     */
    public function filter($category, $subcategory)
    {
        return 'Show all books in these categories: ' . $category . ' , ' . $subcategory;
    }
}