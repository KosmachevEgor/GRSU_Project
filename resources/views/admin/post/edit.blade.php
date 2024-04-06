@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.posts.update', $post->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="post-title">Title</label>
        <input type="text" class="form-control" name='title' id="post-title" placeholder="Title"
               value="{{ $post->title }}">
        @error('title')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="post-content" class="form-label">Content</label>
        <textarea class="form-control" name='content' id="post-content"
                  placeholder="Content">{{$post->content}}</textarea>
        @error('content')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="source_link">source</label>
        <input type="text" class="form-control" name='source_link' id="source_link" placeholder="source"
               value="{{$post->source_link}}">
        @error('source_link')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
@endsection
