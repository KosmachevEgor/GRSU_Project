@extends('admin.layouts.app')
@section('content')
    <div class="info-block">
        <div class="card mb-3" style="max-width: 540px; min-width: 125px;">
            <div class="row g-0 align-items-center">
              <div class="col-md-4">
                <i class="bi bi-archive-fill icon m-2"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body m-2">
                  <h5 class="card-title">Posts</h5>
                  <p class="card-text">180</p>
                  <a href="#" class="btn btn-outline-primary" role="button">Info</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3" style="max-width: 540px; min-width: 125px;">
            <div class="row g-0 align-items-center">
              <div class="col-md-4">
                <i class="bi bi-box-fill icon m-2"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body m-2">
                  <h5 class="card-title">Models</h5>
                  <p class="card-text">5</p>
                  <a href="{{ route('admin.models.index') }}" class="btn btn-outline-primary" role="button">Info</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3" style="max-width: 540px; min-width: 125px;">
            <div class="row g-0 align-items-center">
              <div class="col-md-4">
                <i class="bi bi-diagram-3-fill icon m-2"></i>
              </div>
              <div class="col-md-8">
                <div class="card-body m-2">
                  <h5 class="card-title">Parts</h5>
                  <p class="card-text">5</p>
                  <a href="{{ route('admin.models.index') }}" class="btn btn-outline-primary" role="button">Info</a>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
