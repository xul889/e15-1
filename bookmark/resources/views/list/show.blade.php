@extends('layouts/main')

@section('head')
<link href='/css/list/show.css' rel='stylesheet'>
@endsection

@section('title')
Your List
@endsection

@section('content')

@if($books->count() == 0)
<p dusk='no-books-message'>You have not added any books to your list yet.</p>

<p><a href='/books'>Find books to add in our library...</a></p>
@else

@foreach($books as $book)
<div class='book' dusk='book-on-list'>
    <a href='/books/{{ $book->slug }}'>
        <h2>{{ $book->title }}</h2>
    </a>

    @if($book->author)
        <p>By {{ $book->author->first_name. ' ' . $book->author->last_name }}</p>
    @endif

    <form method='POST' action='#'>
        <textarea class='notes' name='notes' >{{ $book->pivot->notes }}</textarea>
        <button type='submit' class='btn btn-primary'>Update notes</button>
    </form>

    <p class='added'>
        Added {{ $book->pivot->created_at->diffForHumans() }}
    </p>

    <a href='#'><i class='fa fa-minus-circle'></i> Remove from your list</a>
    
</div>
@endforeach

@endif

@endsection
