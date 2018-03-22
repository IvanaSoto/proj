@extends('layouts.app')

@section('content')
	

<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1>Añadir idea</h1>
		
		<form action="{{ route('storeIdea') }}" method="POST">

			@csrf
			
			<div class="form-group">
				<input class="form-control" type="text" placeholder="Titulo" name="title" value="{{ old('title') }}">
			</div>
			<div class="form-group">
				<textarea class="form-control" name="text" rows="5" placeholder="Texto">{{ old('text') }}</textarea>
			</div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-primary"> Guardar </button>
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
</div>

@endsection