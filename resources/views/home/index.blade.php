@extends('layouts.app')
@section('content')
    @vite([
        'public/js/home/index/index.js',
    ])
    <div id = "block1" class="block">
        <h2>Добро пожаловать в Vertebra</h2>
        <img src="{{ asset('image/neck.webp') }}" alt="">
    </div>
    <div id = "block2" class="block">
        <img src="{{ asset('image/disk.png') }}" alt="" style="height: 50%">
        <div>
            <p>-На платформе представлены детальные модели шейного отдела позвоночника</p>
            <p>-К моделям представлены статьи о строении и функциях</p>
            <p>-Vertebra способна погрузить вас в мир строения шейного отдела на основе 3D моделей</p>
        </div>
    </div>
    <div id = "block3" class="block">
        <img src="{{ asset('image/step3.webp') }}" alt="" style="height:95vh">
        <a href="{{ route('virtualTour.index') }}" type="button" class="btn btn-outline-light" style="font-family: 'Pacifico', sans-serif; font-size: calc(var(--index)*1.25)">Начать экскурсию</a>
    </div>
@endsection
