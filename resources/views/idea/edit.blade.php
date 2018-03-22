@extends('layouts.app')

@section('content')
	

<div class="container">
	<h1>Idea</h1>

	<form action="{{ route('updateIdea', [ 'idea' => $idea->id ]) }}" method="POST">

		@csrf
		@method('PUT')
		
		<div class="form-group">
			<input class="form-control" type="text" placeholder="Titulo" name="title" value="{{ $idea->title }}">
		</div>
		<div class="form-group">
			<textarea class="form-control" name="text" rows="5" placeholder="Texto">{{ $idea->text }}</textarea>
		</div>
		<div class="form-group text-center">
			<button type="submit" class="btn btn-primary"> Actualizar </button>
		</div>

	</form>

	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
</div>

@endsection