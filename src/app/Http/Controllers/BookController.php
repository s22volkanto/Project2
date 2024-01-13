<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function saveBookData(Book $book, BookRequest $request)
    {
        $validatedData = $request->validated();
        $book->fill($validatedData);
        $book->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $book->image =  $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $book->save();
    }

    // display all books
    public function list()
    {
        $items = Book::orderBy('name', 'asc')->get();

        return view(
            'book.list',
            [
                'title' => 'Books',
                'items' => $items,
            ]
        );
    }

    // display new book form
    public function create()
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Add a new book',
                'book' => new Book(),
                'authors' => $authors,
                'genres' => $genres,
            ]
        );
    }

    // save new book
    public function put(BookRequest $request)
    {
        $book = new Book();

        $this->saveBookData($book, $request);

        return redirect('/books');
    }

    // display book update form
    public function update(Book $book)
    {
        $authors = Author::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();

        return view(
            'book.form',
            [
                'title' => 'Edit the book',
                'book' => $book,
                'authors' => $authors,
                'genres' => $genres,
            ]
        );
    }

    // update existing book
    public function patch(Book $book, BookRequest $request)
    {
        $this->saveBookData($book, $request);

        return redirect('/books/update/' . $book->id);
    }

    // delete books
    public function delete(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

}
