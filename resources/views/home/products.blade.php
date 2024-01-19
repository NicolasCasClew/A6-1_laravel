<!-- Vista que muestra la página "Acerca de" -->
@extends('layouts.app')

@section('content')
<div class="row">
	@foreach($viewData as $product)

	<div class="col-md-6 col-lg-4 mb-2">
		<img src="{{ asset($product["imgUrl"]) }}" class="img-fluid rounded">
		<p> {{$product["desc"]}}</p>
	</div>

	@endforeach



</div>
@endsection