@extends('layouts.app')
@section('content')
@vite([
    'public/js/spine-model.js'
])
<style>
    body{
        overflow: hidden;
    }
</style>
<input type="hidden" id="spine-model-path" value={{ url('/storage/'.$spineModel->model_path) }}>
<canvas id="main-canvas"></canvas>
@endsection
