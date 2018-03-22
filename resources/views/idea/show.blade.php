@extends('layouts.app')

@section('content')
<div class="container">

    <div>
        <h1>{{ $idea->title }}</h1>
        <p>{{ $idea->text }}</p>
    </div>
    <br>
    <div class="container">
        <h4>{{ $count }} Likes</h4>
    </div>

    <br>
    <div class="text-center">
        <a href="/ideas/{{ $idea->id }}/like" class="btn btn-success btn-lg"> A favor  : ) </a>
        <a href="/ideas/{{ $idea->id }}/dislike" class="btn btn-danger btn-lg"> En contra  : ( </a>
    </div>
</div>
@endsection
