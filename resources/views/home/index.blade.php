<!-- Usamos, como plantilla, la vista layouts.app (/resources/views/layouts/app.blade.php) -->
@extends('layouts.app')

<!-- Inyectamos el texto que contiene el título en el yield "title" -->
@section("subtitle", $viewData["title"])

<!-- Inyectamos el texto con el contenido de la página en el yield "content" -->
@section('content')

<div class="row">
    <div class="col-md-6 col-lg-4 mb-2">
        <img src="{{ asset('/storage/game.png') }}" class="img-fluid rounded">
    </div>
    <div class="col-md-6 col-lg-4 mb-2">
        <img src="{{ asset('/storage/safe.png') }}" class="img-fluid rounded">
    </div>
</div>



@endsection