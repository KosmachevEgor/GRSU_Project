@extends('admin.layouts.app')
@section('content')

<div class="card mb-3" style="max-width: 100%;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ url('/storage/'.$spineModel->model_image_path)}}" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-4">
        <div class="card-body">
          <h5 class="card-title">{{ $spineModel->title }}</h5>
          <p class="card-text">{{ $spineModel->description }}</p>
          <p class="card-text">Parts:
            <b>
            @foreach ($spineModel->parts as $modelPart)
            {{ $modelPart->part_name}}<pre>
            @endforeach
            </b>
        </p>
        </div>
      </div>
      <div class="col-md-4">
        Тут будет 3D preview
      </div>
    </div>
  </div>
@endsection
