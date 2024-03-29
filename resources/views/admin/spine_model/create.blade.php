@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.models.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="model-title">Title</label>
        <input type="text" class="form-control" name='title' id="model-title" placeholder="title">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="description" placeholder="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="model_image" class="form-label">Image</label>
        <input class="form-control" type="file" id="model_image" name="model_image_path">
      </div>
    <div class="mb-3">
        <label for="model_path" class="form-label">Model path</label>
        <input class="form-control" type="file" id="model_path" name="model_path" accept=".glb">
      </div>
      <div>
        <label for="spine_parts">Parts</label>
        <select class="form-select" id="spine_parts" name="spine_parts[]" multiple
                aria-label="multiple select example">
            @foreach($spineParts as $parts)
                <option value="{{$parts->id}}">{{$parts->title}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection
