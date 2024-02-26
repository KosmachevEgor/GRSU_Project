@extends('layouts.app')
@section('content')
<div class="header">
    <h2>Our Models</h2>
</div>

<div class="models-panel">
    @foreach ($spineModels as $model)
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ url('/storage/'.$model->model_image_path) }}" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{ $model->title }}</h5>
              <p class="card-text">{{ $model->description }}</p>
              <a href='{{ route('models.show', $model->id) }}' class="card-text">Show model</a>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
