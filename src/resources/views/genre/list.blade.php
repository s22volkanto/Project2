@extends('layout')

@section('content')

    	<h1>{{ $title }}</h1>
    	<hr>

    	@if (count($items) > 0)

        	<table class="table table-striped table-hover table-sm">
            		<thead class="">
                		<tr>
                    			<th>ID</th>
                    			<th>Title</th>
                    			<th>Actions</th>
                		</tr>
            		</thead>
            		<tbody>

                		@foreach($items as $genre)
                		<tr>
                   			<td>{{ $genre->id }}</td>
                    			<td>{{ $genre->name }}</td>
                    			<td>
                        			<a href="/genres/update/{{ $genre->id }}" class="btn btn-outline-primary btn-sm">Edit</a>
                        			/
                        			<form method="post" action="/genres/delete/{{ $genre->id }}" class="deletion-form d-inline">
                           				 @csrf
                            				<button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        			</form>
                    			</td>
                		</tr>
                		@endforeach

            		</tbody>
        	</table>

    	@else

        	<p>No record found</p>

    	@endif

    	<a href="/genres/create" class="btn btn-primary">Add new genre</a>

@endsection