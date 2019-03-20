@if(Auth::user()->image)
								<!--<img src="{{url('user/avatar/'.Auth::user()->image)}}"-->
	<img class="avatar p-0" src="{{route('user.avatar',['filename'=>Auth::user()->image])}}">
@endif