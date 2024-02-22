@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.parts.update', $spinePart->id) }}" method="post">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="part-name" class="form-label">Part Name</label>
        <input type="text" class="form-control" name='part_name' id="part-name" placeholder="Name"
        value="{{ $spinePart->part_name}}">
        @error('part_name')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="part-title">Title</label>
        <input type="text" class="form-control" name='title' id="part-title" placeholder="title"
        value="{{ $spinePart->title}}">
        @error('title')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="part-description" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="part-description" placeholder="description">{{ $spinePart->description }}</textarea>
        @error('description')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
