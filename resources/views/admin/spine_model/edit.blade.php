@extends('admin.layouts.app')
@section('content')
<form action="{{ route('admin.models.update', $spineModel->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="model-title">Title</label>
        <input type="text" class="form-control" name='title' id="model-title" placeholder="title"
        value="{{ $spineModel->title}}">
        @error('title')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name='description' id="description" placeholder="description">{{ $spineModel->description }}</textarea>
        @error('description')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">

        <label for="model_image" class="form-label">Image</label>
        <input class="form-control" type="file" id="model_image" name="model_image_path">
        <label for="current_model_image" class="form-label">Current image:</label>
        <img src="{{ url('/storage/'.$spineModel->model_image_path) }}" alt="Current Image" style="max-width: 200px;">
        @error('model_image_path')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="model_path" class="form-label">Model path</label>
        <input class="form-control" type="file" id="model_path" name="model_path" accept=".glb">
        <p><b>Current model path: </b> {{ $spineModel->model_path }}</p>
        @error('model_path')
            <p class='text-danger'>{{ $message }}</p>
        @enderror
    </div>
      <div>
        <label for="spine_parts">Parts</label>
        <select class="form-select" id="spine_parts" name="spine_parts[]" multiple
                aria-label="multiple select example">
                @foreach($spineParts as $part)
                <option
                    @foreach($spineModel->parts as $spinePart)
                        {{$part->id === $spinePart->id ? ' selected' : ''}}
                    @endforeach
                    value="{{$part->id}}">{{$part->title}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
