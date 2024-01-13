<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
	public function __construct()
    	{
        	$this->middleware('auth');
    	}

    	private function saveGenreData(Genre $genre, GenreRequest $request)
    	{
        	$validatedData = $request->validated();
        	$genre->fill($validatedData);

        	$genre->save();
    	}

    	public function list()
    	{
        	$items = Genre::orderBy('name', 'asc')->get();

        	return view(
            		'genre.list',
            		[
                		'title' => 'Genre',
                		'items' => $items,
            		]
        	);
    	}

    	public function create()
    	{
        	return view(
            		'genre.form',
            		[
                		'title' => 'Add new genre',
                		'genre' => new Genre(),
            		]
        	);
    	}

    	public function put(GenreRequest $request)
    	{
        	$genre = new Genre();
        	$this->saveGenreData($genre, $request);
        	return redirect('/genres');
    	}

    	public function update(Genre $genre)
    	{
        	return view(
            		'genre.form',
            		[
                		'title' => 'Edit genre',
                		'genre' => $genre,
            		]
        	);
    	}

    	public function patch(Genre $genre, GenreRequest $request)
    	{
        	$this->saveGenreData($genre, $request);
        	return redirect('/genres');
    	}

    	public function delete(Genre $genre)
    	{
        	$genre->delete();
        	return redirect('/genres');
    	}
}
