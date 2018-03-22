@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ideas</h1>
    <br>
    <h2>Mis ideas</h2>
    <ul class="list-group">
        @foreach( $myIdeas as $idea )
            <li class="list-group-item">
                <a href="/ideas/{{ $idea->id }}"> {{ $idea->title }} </a>
                <a href="/ideas/{{ $idea->id }}/edit" class="btn btn-primary float-right"> Editar </a>
                <a href="/ideas/{{ $idea->id }}/delete" class="btn btn-danger float-right"> Eliminar </a>
            </li>
        @endforeach
    </ul>
    <br>
    <h2>Todas</h2>
    <ul class="list-group">
        @foreach( $ideas as $idea )
            <li class="list-group-item">
                <a href="/ideas/{{ $idea->id }}"> {{ $idea->title }} </a>
            </li>
        @endforeach
    </ul>
    <div class="text-center">
        <a href="/ideas/new" class="btn btn-primary"> Añadir idea </a>
    </div>
</div>
@endsection
