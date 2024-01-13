@extends('layout')

@section('content')

    	<h1>{{ $title }}</h1>
    	<hr>

    	@if ($errors->any())
        	<div class="alert alert-danger" role="alert">
            		Please fix the errors!
        	</div>
    	@endif


    	<form method="post" action="{{ $genre->exists ? '/genres/patch/' . $genre->id : '/genres/put' }}">
        	@csrf

        		<div class="mb-3">
            			<label for="genre-name" class="form-label">Genre name</label>

            			<input
                			type="text"
                			id="genre-name"
                			name="name"
                			class="form-control @error('name') is-invalid @enderror"
                			value="{{ old('name', $genre->name) }}"
            			>

            			@error('name')
                			<p class="invalid-feedback">{{ $errors->first('name') }}</p>
            			@enderror
        		</div>

        		<button type="submit" class="btn btn-primary">{{ $genre->exists ? 'Restore' : 'Add' }}</button>

    	</form>

@endsection