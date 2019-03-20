<?php

namespace	App\Http\Controllers;

use	Illuminate\Http\Request;
use	App\Like;

class	LikeController	extends	Controller	{

	public	function	__construct()	{
		$this->middleware('auth');
	}

	public	function	index()	{
		$user	=	\Auth::user();
		$likes	=	Like::orderBy('id',	'desc')->where('user_id',	$user->id)->paginate(5);
		return	view('like.index',	[
						'likes'	=>	$likes,
		]);
	}

	public	function	like($image_id)	{
		// Recoger datos del usuario y la imagen
		$user	=	\Auth::user();

		// Condicion para ver si ya existe like y no duplicarlo
		$isset_like	=	Like::where('user_id',	$user->id)->where('image_id',	$image_id)->count();
		// Si no tiene likes
		if	($isset_like	==	0)	{
			$like	=	new	Like();
			$like->user_id	=	$user->id;
			$like->image_id	=	(int)	$image_id;
			$like->save();

			return	response()->json([
															'like'	=>	$like
			]);
		}	else	{
			return	response()->json([
															'like'	=>	'El like ya existe'
			]);
		}
	}

	public	function	dislike($image_id)	{
		// Recoger datos del usuario y la imagen
		$user	=	\Auth::user();

		// Condicion para ver si ya existe like y no duplicarlo
		$like	=	Like::where('user_id',	$user->id)->where('image_id',	$image_id)->first();
		// Si no tiene likes
		if	($like)	{
			$like->delete();

			return	response()->json([
															'like'	=>	$like,
															'message'	=>	'Has dado dislike'
			]);
		}	else	{
			return	response()->json([
															'like'	=>	'El like no existe'
			]);
		}
	}

}
