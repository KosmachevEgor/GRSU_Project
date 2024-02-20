@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.parts.store') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="part-description" class="form-label">Part Name</label>
        <textarea class="form-control" name='part_name' id="part-description" placeholder="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="part-title">Title</label>
        <input type="text" class="form-control" name='title' id="part-title" placeholder="title">
    </div>
    <div class="mb-3">
        <label for="part-description" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="part-description" placeholder="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
