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
                <button class="btn btn-danger float-right" data-id="{{ $idea->id }}" data-toggle="modal" data-target="#deleteModal">
                    Eliminar
                </button>
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

    <form action="{{ route('destroyIdea') }}" method="POST">
        @csrf
        @method('DELETE')

        <input type="hidden" id="ideaDeleteId">

        @component('components.modal')
            @slot('id') deleteModal @endslot
            @slot('title') Eliminar Idea @endslot
            @slot('content') ¿Estas seguro que quieres eliminar la idea D:? @endslot
            @slot('footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">nah</button>
                <button type="submit" class="btn btn-danger">Si, >:D </button>
            @endslot
        @endcomponent

    </form>
</div>
@endsection

@section('js')
    <script type="text/javascript">

    $(document).ready(function() {

    })

    </script>
@endsection
        