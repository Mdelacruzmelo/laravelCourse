<div class="card mb-3">

	<div class="card-header">
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
			{{'@'.$image->user->nick}} | 
			<span class="text-muted text-small">
				{{ \FormatTime::LongTimeFilter($image->created_at)}}
			</span>
		</span>
		{{$image->description}}
	</div>
	<div class="col-4 pb-3">
		<a href="{{route('image.detail',['id'=>$image->id])}}" class="btn btn-sm btn-success">
			Comentarios ( {{count($image->comments)}} )
		</a>
	</div>


</div>