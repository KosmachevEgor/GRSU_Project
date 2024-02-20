@extends('admin.layouts.app')
@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">created_at</th>
        <th scope="col">updated_at</th>
      </tr>
    </thead>
    <tbody>
          @foreach ($parts as $part)
          <tr>
            <th scope="row">{{ $part->id }}</th>
            <td>{{ $part->title }}</td>
            <td>{{ $part->description }}</td>
            <td>{{ $part->created_at }}</td>
            <td>{{ $part->updated_at }}</td>
          </tr>
          @endforeach
    </tbody>
  </table>
  <a href="{{ route('admin.parts.create') }}" class="btn btn-outline-primary" role="button">Create Part</a>
@endsection
