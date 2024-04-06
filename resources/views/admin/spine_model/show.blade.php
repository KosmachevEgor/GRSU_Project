@extends('admin.layouts.app')
@section('content')
@vite([
    'public/js/admin/single-spine-model.js'
])
<div class="card">
    <div class="row g-0">
      <div class="col-md-5">
        <div class="card-body">
          <h5 class="card-title">{{ $spineModel->title }}</h5>
          <p class="card-text">{{ $spineModel->description }}</p>
          <p class="card-text">Parts:
            <b>
            @foreach ($spineModel->parts as $modelPart)
            {{ $modelPart->part_name}}
            @endforeach
            </b>
        </p>
        </div>
      </div>
      <input type="hidden" id="spine-model-path" value={{ url('/storage/'.$spineModel->model_path) }}>
      <div class="col-md-7" style="position: relative">
        <canvas id="main-canvas"></canvas>
      </div>
    </div>
  </div>
@endsection
