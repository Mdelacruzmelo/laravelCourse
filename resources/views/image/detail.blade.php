@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">

			@include('includes.message')

			<div class="card mb-3">

				<div class="card-header">
					@if($image->user->image)
					<div class="container-avatar pub_image pub_image_detail float-left">
						<img src="{{route('user.avatar',['filename'=>$image->user->image])}}">
					</div>
					@endif
					<div class="data-user">
						<!--{{$image->user->name.' '.$image->user->surname}} |--> 
						{{$image->user->nick}}
					</div>

				</div>

				<div class="card-body p-0 imageDashboard">
					<img src="{{route('image.file',['filename'=>$image->image_path])}}">
				</div>

				<div class='likes pl-4 pt-3'>

					<!-- Comprobar si el usuario ya le dio like -->
					<?php	$user_like	=	false;	?>
					@foreach($image->likes as $like)
					@if($like->user->id == Auth::user()->id)
					<?php	$user_like	=	true;	?>
					@endif
					@endforeach

					@if($user_like)
					<img class="btn-dislike heartimg" data-id="{{$image->id}}" src="{{asset('img/redheart.png')}}">
					@else
					<img class="btn-like heartimg" data-id="{{$image->id}}" src="{{asset('img/blackheart.png')}}">
					@endif

					<span class="font-weight-bold px-1" style="font-size: .9rem;">
						{{@count($image->likes)}}
					</span>

				</div>

				<div class='description pt-2 px-4 pb-2'>
					<span class="font-weight-bold text-muted d-block">
						{{'@'.$image->user->nick}} 
					</span>
					{{$image->description}}
					@if(Auth::user() && Auth::user()->id == $image->user->id)
					<a href="{{route('image.edit',['id'=>$image->id])}}" class="btn btn-sm btn-dark ml-2 float-right">
						Cambiar
					</a>
					<a href="{{route('image.delete',['id'=>$image->id])}}" class="btn btn-sm btn-light ml-4 float-right">
						Borrar
					</a>
					@endif

				</div>

				<div class="clearfix"></div>

				<div class="col-12 pb-3">
					<h4 class="pt-3 px-2 pb-0">Comentarios ( {{count($image->comments)}} )</h4>

					<hr>

					@foreach($image->comments as $comment)
					<div class="comment pl-4 mb-3">

						@if($image->user->image)
						<div class="container-avatar pub_image pub_image_detail float-left mr-3">
							<img src="{{route('user.avatar',['filename'=>$comment->user->image])}}">
						</div>
						@endif

						<div class='description pt-2 '>
							<span class="font-weight-bold text-muted d-block">
								{{'@'.$comment->user->nick}} |
								<span class="text-muted text-small">
									{{ \FormatTime::LongTimeFilter($image->created_at)}}
								</span>
							</span>
							{{$comment->content}}

							@if(Auth::check()	&&	$comment->user_id	==	Auth::user()->id	||	$comment->image->user_id	==	Auth::user()->id)
							<a class="btn btn-sm btn-light float-right" href="{{route('comment.delete',['id'=>$comment->id])}}">
								Eliminar
							</a>
							@endif
						</div>

					</div>
					@endforeach

					<hr>

					<form method="POST" action="{{route('comment.save')}}">
						@csrf
						<input type="hidden" name="image_id" value="{{$image->id}}">
						<p>
							<textarea class="form-control {{$errors->has('content')? 'is-invalid' :''}}" name="content">
							</textarea>
							@if($errors->has('content'))
							<span class="invalid-feedback d-inline" role='alert'>
								<strong>{{$errors->first('content')}}</strong>
							</span>
							@endif
						</p>
						<input type="submit" value="Enviar" class="btn btn-success float-right">
					</form>
				</div>

			</div>

		</div>
	</div>
</div>
@endsection
