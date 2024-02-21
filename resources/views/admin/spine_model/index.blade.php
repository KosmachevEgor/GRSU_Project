@extends('admin.layouts.app')
@section('content')
  <a href="{{ route('admin.models.create') }}" class="btn btn-outline-primary" role="button">Create Model</a>
  <div class="info-block">
    @foreach ($spineModels as $model)
    <div class="card m-1" style="width: 18rem;">
      <img src="{{ url('/storage/'.$model->model_image_path)}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{ $model->title }}</h5>
        <p class="card-text">{{ $model->description }}</p>
      </div>
      <ul class="list-group list-group-flush">
      <li class="list-group-item">{{ $model->model_path }}</li>
      <li class="list-group-item">
          @foreach ($model->parts as $modelPart)
              {{ $modelPart->part_name}}
          @endforeach
      </li>
        <li class="list-group-item">Created at: <b>{{ $model->created_at }}</b></li>
      </ul>
      <div class="card-body">
        <a href="{{ route('admin.models.show', $model->id) }}" class="card-link">Show</a>
        <a href="#" class="card-link">Edit</a>
        <a href="#" class="card-link">Delete</a>
      </div>
    </div>
    @endforeach
  </div>

@endsection
