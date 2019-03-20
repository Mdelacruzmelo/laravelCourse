@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">

			@include('includes.message')

			<div class="data-user py-3 px-0">
				<div class="col-md-3 p-0 float-left">
					@if($user->image)
					<div class="container-avatar overflow-hidden" style="border-radius: 4px; border: 1px solid #dfdfdf">
						<a href="{{route('profile',['id'=>Auth::user()->id])}}">
							<img style="width: 100%" src="{{route('user.avatar',['filename'=>$user->image])}}">
						</a>
					</div>
					@endif
				</div>
				<div class="col-md-8 px-3 py-0 float-left">
					<h2>{{'@'.$user->nick}}</h2>
					<h4 class="mt-4">{{$user->name." ".$user->surname}}</h4>
					<p>{{'Se unió '. \FormatTime::LongTimeFilter($user->created_at)}}</p>
				</div>
			</div>

			{{--
			@foreach($user->images as $image)
			<!-- Mostrar la plantilla de una imagen dentro del foreach -->
			@include('includes.image',['image'=>$image])
			@endforeach --}}

		</div>
		<div class="col-md-8 d-flex flex-wrap mt-2">
			@foreach($user->images as $image)
			<button 	href="" 
												type="button" 
												data-toggle="modal" 
												data-target="#exampleModal{{$image->id}}"
												style="
												cursor: pointer;
												height: 200px; 
												border: 1px solid white;
												background-size: cover; 
												background-position: center; 
												background-image: url({{route('image.file',['filename'=>$image->image_path])}})" 
												class="col-4">
			</button>
			@include('includes.modal',['image'=>$image])
			@endforeach
		</div>
	</div>
</div>
@endsection
