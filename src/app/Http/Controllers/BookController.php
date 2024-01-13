<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
 			$book->image = $uploadedFile->storePubliclyAs(
 				'/',
 				$name . '.' . $extension,
 				'uploads'
 			);
 		}

 		$book->save();
	}

    	public function list()
	{
 		$items = Book::orderBy('name', 'asc')->get();

 		return view(
 			'book.list',
 			[
 			'title' => 'Books',
 			'items' => $items
 			]
 		);
	}

	public function create()
	{
 		$authors = Author::orderBy('name', 'asc')->get();

 		return view(
 			'book.form',
 			[
 				'title' => 'Add book',
 				'book' => new Book(),
 				'authors' => $authors,
 			]
 		);
	}

	public function put(BookRequest $request)
	{
 		$book = new Book();
 		$this->saveBookData($book, $request);
 		return redirect('/books');
	}

	public function update(Book $book)
	{
 		$authors = Author::orderBy('name', 'asc')->get();

 		return view(
 			'book.form',
 			[
 				'title' => 'Edit book',
 				'book' => $book,
 				'authors' => $authors,
 			]
 		);
	}

	public function patch(Book $book, BookRequest $request)
	{
 		$this->saveBookData($book, $request);
 		return redirect('/books/update/' . $book->id);
	}

	public function delete(Book $book)
	{
 		$book->delete();
 		return redirect('/books');
	}

}

