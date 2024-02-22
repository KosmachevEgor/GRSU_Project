@extends('admin.layouts.app')
@section('content')

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">created_at</th>
        <th scope="col">updated_at</th>
        <th scope='col'>Edit</th>
        <th scope='col'>Delete</th>
      </tr>
    </thead>
    <tbody>
          @foreach ($parts as $part)
          <tr>
            <th scope="row">{{ $part->id }}</th>
            <td>{{ $part->part_name }}</td>
            <td>{{ $part->title }}</td>
            <td>{{ $part->description }}</td>
            <td>{{ $part->created_at }}</td>
            <td>{{ $part->updated_at }}</td>
            <td><a href="{{ route('admin.parts.edit', $part->id) }}">Edit</a></td>
            <td>
                <form method="POST" action="{{ route('admin.parts.destroy', $part->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this part?')">Delete</button>
                </form>
            </td>
          </tr>
          @endforeach
    </tbody>
  </table>
  <a href="{{ route('admin.parts.create') }}" class="btn btn-outline-primary" role="button">Create Part</a>
@endsection
