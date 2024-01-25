<!-- Vista que muestra la página "Acerca de" -->
@extends('layouts.app')
@section("title", $viewData["title"])
@section("subtitle", $viewData["subtitle"])


@section('content')
<div class="row">
    @foreach($viewData["products"] as $product)

    <div class="col-md-6 col-lg-4 mb-2">
        <img src="{{ asset($product["imgUrl"]) }}" class="img-fluid rounded">
        <a class="btn btn-primary" href="{{route('home.product',$product['id'])}}">Comprar {{$product["nombre"]}}</a>
    </div>

    @endforeach



</div>
@endsection