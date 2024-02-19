@extends('admin.layouts.app')
@section('content')
<div class="header">
    <h2>Virtual tour of the spine</h2>
</div>
<div class="text-section">
    <p>
        Данный сайт создан исключительно в информационных целях.
        Это позволит получить общее представление о строении шейного отдела позвоночника, межпозвонкового диска, пульпозного ядра и плазматической мембраны.
    </p>
    <video src="{{ asset('video/4k_end.webm') }}" autoplay loop muted>
</div>
@endsection
