@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="GET" action="{{route('index')}}" id="buscador">
				<div class="input-group mb-3">
					<input type="text" class="form-control"
												id="search"
												placeholder="Nombre de usuario" 
												aria-label="Nombre de usuario">
					<div class="input-group-append">
						<button class="btn btn-outline-light text-dark border" type="submit">Buscar</button>
					</div>
				</div>
			</form>
			@foreach($users as $user)

			<div class="data-user py-3 px-5 col-12 d-flex justify-content-center">
				<div class="col-lg-3 col-md-4 col-sm-5 p-0 float-left border-0">

					<div class="container-avatar overflow-hidden border-0" style="border-radius: 4px; border: 1px solid #dfdfdf">
						<a href="{{route('profile',['id'=>$user->id])}}">
							@if($user->image)
							<div class="userIndexImage" style="background-image: url('{{route('user.avatar',['filename'=>$user->image])}}');"></div>
							@else
							<img class="userIndexImage" style="background-image: url('{{asset('img/unknownUser.jpg')}}');">
							@endif
						</a> 
					</div>



				</div>
				<div class="col-md-7 col-sm-7 px-3 py-0 float-left">
					<h3>{{'@'.$user->nick}}</h3>
					<h4 class="mt-4">{{$user->name." ".$user->surname}}</h4>
					<p>{{'Se unió '. \FormatTime::LongTimeFilter($user->created_at)}}</p>
					<a href="{{route('profile',['id'=>$user->id])}}" class='btn btn-success btn-sm'>Ver perfil</a>
				</div>
			</div>


			@endforeach
			<!-- Pagination -->
			<div class='clearfix'></div>
			<div class="d-flex justify-content-center">
				<div class='mt-3 text-center'>
					{{$users->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
