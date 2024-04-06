@extends('layouts.app')
@section('content')
    @vite(['public/js/virtual-tour/app.js', 'public/css/virtual-tour/app.css'])
    <style>
        body{
            overflow: hidden;
        }
        </style>
    <input type="hidden" id="spine-models" value="{{ json_encode($spineModels) }}">
    <div id="infoDiv" class="hidden">
        <h2 style="color:aliceblue">Добро пожаловать!</h2>
        <div id='icons-div'>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('video/click.gif') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Нажмите левой кнопкой мыши по части объекта, чтобы полученить информацию о нём</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('video/3D.gif') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Задержите левую кнопку и вращайте мышью, чтобы производить движение камерой вокруг объекта</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('video/longClick.gif') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Зажмите левую кнопку мыши когда курсор находится на модели, чтобы перейти к следующей</p>
                </div>
            </div>
        </div>
        <button type="button" id='sucsess-btn' class="btn btn-outline-light">Понял!</button>
    </div>
    <div class="position-absolute top-10 start-50 translate-middle-x">
        <select id ='nav-parts'class="form-select" aria-label="Default select example">
            
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
    <canvas id="main-canvas"></canvas>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const infoDiv = document.getElementById("infoDiv")
            infoDiv.classList.remove("hidden")
            setTimeout(function() {
                infoDiv.style.opacity = 1
            }, 100)

            const btn = document.getElementById('sucsess-btn')
            btn.addEventListener('click', function() {
                infoDiv.style.display = 'none'
            })

        });
    </script>
@endsection
