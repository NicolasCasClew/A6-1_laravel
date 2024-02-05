<!-- Usamos, como plantilla, la vista layouts.app (/resources/views/layouts/app.blade.php) -->
@extends('layouts.app')

<!-- Inyectamos el texto que contiene el título en el yield "title" -->
@section("subtitle", $viewData["title"])

<!-- Inyectamos el texto con el contenido de la página en el yield "content" -->
@section('content')

<div class="row">
    <div class="col-md-6 col-lg-4 mb-2">
        <img src="{{ asset($viewData['url']) }}" class="img-fluid rounded">
    </div>
    <div class="col-md-6 col-lg-4 mb-2">
        <div class="container">
            <h1>{{$viewData["name"]}}</h1>
            <br>
            <h2>{{$viewData["price"]}} £</h2>
            <br>
            <h4>{{$viewData["desc"]}}</h4>
        </div>
    </div>
</div>



@endsection