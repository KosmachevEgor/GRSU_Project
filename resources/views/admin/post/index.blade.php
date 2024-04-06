@extends('admin.layouts.app')
@section('content')
<a href="{{ route('admin.post.create') }}" class="btn btn-outline-primary" role="button">Create Post</a>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Source</th>
        <th scope="col">created_at</th>
        <th scope="col">updated_at</th>
        <th scope='col'>Edit</th>
        <th scope='col'>Delete</th>
      </tr>
    </thead>
    <tbody>
          @foreach ($posts as $post)
          <tr>
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td>{{ $post->content }}</td>
            <td><a href="{{ $post->source_link }}">{{ $post->source_link }}</a></td>
            <td>{{ $post->created_at }}</td>
            <td>{{ $post->updated_at }}</td>
            <td><a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a></td>
            <td>
                <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </td>
          </tr>
          @endforeach
    </tbody>
  </table>
@endsection
