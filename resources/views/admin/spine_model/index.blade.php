@extends('admin.layouts.app')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Model</th>
        <th scope="col">Imgae</th>
        <th scope='col'>Parts</th>
        <th scope="col">created_at</th>
        <th scope="col">updated_at</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($spineModels as $model)
        <tr>
            <th scope="row">{{ $model->id }}</th>
            <td>{{ $model->title }}</td>
            <td>{{ $model->description }}</td>
            <td>{{ $model->model_path }}</td>
            <td>{{ $model->model_image_path }}</td>
            <td>
                @foreach ($model->parts as $modelPart)
                    {{ $modelPart->part_name}}</br>
                @endforeach
            </td>
            <td>{{ $model->created_at }}</td>
            <td>{{ $model->updated_at }}</td>
          </tr>
        @endforeach
    </tbody>
  </table>
  <a href="{{ route('admin.models.create') }}" class="btn btn-outline-primary" role="button">Create Model</a>
@endsection
