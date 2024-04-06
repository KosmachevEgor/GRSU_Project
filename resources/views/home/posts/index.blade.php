@extends('layouts.app')
@section('content')
    @foreach ($posts as $post)
        <div class="card w-90">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <a href="{{ $post->source_link }}" class="btn btn-primary">Источник</a>
            </div>
        </div>
    @endforeach
@endsection
