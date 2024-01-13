
@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Published</th>
                    <th>Activities</th>
                </tr>
            </thead>
            <tbody>

                @foreach($items as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->name }}</td>
                    <td>{{ $book->author->name }}</td>
                    <td>{{ optional($book->genre)->name }}</td>
                    <td>{{ $book->year }}</td>
                    <td>&euro; {{ number_format($book->price, 2, '.') }}</td>
                    <td>{!! $book->display ? '&#x2714;' : '&#x274C;' !!}</td>
                    <td>
                        <a href="/books/update/{{ $book->id }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        /
                        <form method="post" action="/books/delete/{{ $book->id }}" class="deletion-form d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    @else

        <p>No record found in database</p>

    @endif

    <a href="/books/create" class="btn btn-primary">Add a new book</a>

@endsection
