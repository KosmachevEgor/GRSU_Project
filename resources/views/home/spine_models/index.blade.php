@extends('layouts.app')
@section('content')
    <div id='myDiv' class = 'hidden'
        style="position: fixed; width:100%; height:100vh; background-color:rgb(71, 71, 71); z-index: 4; opacity: 0.8;">
        <div style="position: absolute; top:180px; left:1%">
            <img src="{{ asset('image/arrow3.png') }}" alt="">
            <p style="font-size:32px; color:aliceblue">Чтобы начать виртуальную экскурсию нажмите на <i
                    class="bi bi-badge-vr-fill"></i></p>
        </div>
    </div>
    <div class="header">
        <h2>Модели</h2>
    </div>
    <div class="card-group">
        @foreach ($spineModels as $model)
            <div class="card">
                <a href='{{ route('models.show', $model->id) }}'>
                    <img src="{{ url('/storage/' . $model->model_image_path) }}" class="img-fluid rounded-start"
                        alt="{{ $model->title }}">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $model->title }}</h5>
                    <p class="card-text">{{ $model->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .hidden {
            display: none;
        }

        .fade-in {
            animation: fadeInOut 4s forwards;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const block = document.getElementById('myDiv')
            block.classList.remove('hidden')
            block.classList.add('fade-in')
            setTimeout(() => {
                block.classList.remove('fade-in')
                block.classList.add('hidden')
            }, 4000);
        })
    </script>
@endsection
