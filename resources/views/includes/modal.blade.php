<!-- Modal -->
<div class="modal fade" 
					id="exampleModal{{$image->id}}" 
					tabindex="-1" 
					role="dialog" 
					aria-labelledby="exampleModalLabel" 
					aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-start">
				@if($image->user->image)
				<div class="container-avatar pub_image float-left">
					<a href="{{route('profile',['id'=>Auth::user()->id])}}">
						<img src="{{route('user.avatar',['filename'=>$image->user->image])}}">
					</a>
				</div>
				@endif
				<div class="data-user">
					<!--{{$image->user->name.' '.$image->user->surname}} |--> 
					<a class="text-dark" href="{{route('profile',['id'=>Auth::user()->id])}}">
						{{$image->user->nick}}
					</a>
				</div>
			</div>

			<div class="modal-body p-0">
				<img class="col-12 p-0" src="{{route('image.file',['filename'=>$image->image_path])}}">
			</div>
			<div class="modal-body pt-4 px-4 pb-0">
				<div class='likes p-0'>

					<!-- Comprobar si el usuario ya le dio like -->
					<?php	$user_like	=	false;	?>
					@foreach($image->likes as $like)
					@if($like->user->id == Auth::user()->id)
					<?php	$user_like	=	true;	?>
					@endif
					@endforeach

					@if($user_like)
					<img class="btn-dislike heartimg" 
										data-id="{{$image->id}}" 
										src="{{asset('img/redheart.png')}}">
					@else
					<img class="btn-like heartimg" 
										data-id="{{$image->id}}" 
										src="{{asset('img/blackheart.png')}}">
					@endif

					<span class="font-weight-bold px-1" style="font-size: .9rem;">
						{{@count($image->likes)}}
					</span>
					<div class='description px-0 pb-0 pt-2'>
						<span class="font-weight-bold text-muted d-block">
							{{'@'.$image->user->nick}} | 
							<span class="text-muted text-small">
								{{ \FormatTime::LongTimeFilter($image->created_at)}}
							</span>
						</span>
						{{$image->description}}
					</div>
				</div>
			</div>
			<div class="modal-body px-4 pt-2 pb-4">
				<h3>Comentarios <span class="text-muted small"> {{count($image->comments)}} </span></h3>

				@foreach($image->comments as $comment)
				<div class="comment">
					<div class='description pt-2 col-12 px-0 float-right'>
						@if($image->user->image)
						<div class="container-avatar pub_image pub_image_detail float-left mr-3">
							<img src="{{route('user.avatar',['filename'=>$comment->user->image])}}">
						</div>
						@endif
						<span class="font-weight-bold text-muted d-block">
							{{'@'.$comment->user->nick}} |
							<span class="text-muted text-small">
								{{ \FormatTime::LongTimeFilter($image->created_at)}}
							</span>
						</span>
						<p class="col-8 px-0 float-left">
							{{$comment->content}}
						</p>
						@if(Auth::check()	&&	$comment->user_id	==	Auth::user()->id	||	$comment->image->user_id	==	Auth::user()->id)
						<a class="btn btn-sm btn-light float-right" href="{{route('comment.delete',['id'=>$comment->id])}}">
							Eliminar
						</a>
						@endif
					</div>

				</div>
				@endforeach

				<form method="POST" action="{{route('comment.save')}}">
					@csrf
					<input type="hidden" name="image_id" value="{{$image->id}}">
					<input type="hidden" name="haciaperfil" value="{{Auth::user()->id}}">
					@if($image->user->image)
					<div class="container-avatar pub_image float-left">
						<a href="{{route('profile',['id'=>Auth::user()->id])}}">
							<img src="{{route('user.avatar',['filename'=>$image->user->image])}}">
						</a>
					</div>
					@endif
					<textarea class="form-control col-10 float-right rounded mb-3 {{$errors->has('content')? 'is-invalid' :''}}" 
															name="content" placeholder="Añade tu comentario...">
					</textarea>
					@if($errors->has('content'))
					<span class="invalid-feedback d-inline" role='alert'>
						<strong>{{$errors->first('content')}}</strong>
					</span>
					@endif
					<input type="submit" value="Comentar" class="btn btn-success float-right">
				</form>

			</div>{{--
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Comentar</button>
			</div> --}}
		</div>
	</div>
</div>