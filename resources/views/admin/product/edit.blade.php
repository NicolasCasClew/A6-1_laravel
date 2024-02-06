@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Editar producto
    </div>
    <div class="card-body">

        <form method="POST" action="{{route('admin.product.update',$viewData['id'])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nombre:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ $viewData['name'] }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Precio:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="price" value="{{ $viewData['price'] }}" type="number" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Imagen:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                    <input name="image" value="" type="file" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ $viewData['desc'] }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection