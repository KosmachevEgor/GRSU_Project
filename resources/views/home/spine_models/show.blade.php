@extends('layouts.app')
@section('content')
    @vite(['public/js/spine-model.js'])
    <div class="position-absolute top-10 start-50 translate-middle-x">
        <select id ='nav-parts'class="form-select" aria-label="Default select example">
            @foreach ($spineModel->parts as $part)
            <option value="{{ $part->part_name }}">{{ $part->title }}</option>
            @endforeach
          </select>
    </div>
    <div style=" position:fixed; top: 2%;color:white; left:88%; width:200px; background-color:rgba(0, 0, 0, 0.384)">
        <button type="button" id='btn-autoRotate-cam' class="btn btn-dark btn-lg" data-bs-toggle="button">Автовращение
            камерой</button>
        <button type="button" id ='btn-control-cam' class="btn btn-dark btn-lg active" data-bs-toggle="button">Вкл/Выкл
            управление
            камерой</button>
        <div style="text-align: center; background-color:black">
            <label for="exampleColorInput" class="form-label fs-5">Цвет фона</label>
            <input type="color" id='color-picker'
                style=" position:relative; width:100%;"class="form-control form-control-color" id="exampleColorInput"
                value="#495A69" title="Choose your color">
        </div>
    </div>
    <input type="hidden" id="spine-model-path" value={{ url('/storage/' . $spineModel->model_path) }}>
    <input type="hidden" id="spine-model-title" value={{ $spineModel->title }}>
    <canvas id="main-canvas"></canvas>
@endsection
