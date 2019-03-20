@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			@include('includes.message')

			@foreach($images as $image)
<!-- Mostrar la plantilla de una imagen dentro del foreach -->
				@include('includes.image',['image'=>$image])

			@endforeach
			<!-- Pagination -->
			<div class='clearfix'></div>
			<div class='col-12 text-center'>
				{{$images->links()}}
			</div>
		</div>
	</div>
</div>
@endsection
