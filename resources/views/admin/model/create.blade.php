@extends('admin.layouts.app')
@section('content')
<form action="#" method="post">
    @csrf
    <div class="mb-3">
        <label for="model-title">Title</label>
        <input type="text" class="form-control" name='title' id="model-title" placeholder="title">
    </div>
    <div class="mb-3">
        <label for="model-content" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="model-description" placeholder="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="model_image" class="form-label">Image</label>
        <input class="form-control" type="file" id="model_image" name="model_image">
      </div>
    <div class="mb-3">
        <label for="model_path" class="form-label">Model path</label>
        <input class="form-control" type="file" id="model_path" name="model_path" accept=".glb">
      </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
