<?php

namespace	App\Http\Controllers;

use	Illuminate\Http\Request;
use	App\Comment;

class	CommentController	extends	Controller	{

	public	function	__construct()	{
		$this->middleware('auth');
	}

	public	function	save(Request	$request)	{

		// Validation
		$validate	=	$this->validate($request,	[
						'image_id'	=>	'integer|required',
						'content'	=>	'string|required',
		]);

		// Recoger datos del formulario
		$user	=	\Auth::user();
		$haciaperfilid	=	$request->input('haciaperfil');
		$image_id	=	$request->input('image_id');
		$content	=	$request->input('content');

		// Asigno los valores a mi nuevo objeto
		$comment	=	new	Comment();
		$comment->user_id	=	$user->id;
		$comment->image_id	=	$image_id;
		$comment->content	=	$content;

		// Guardo en la base de datos
		$comment->save();

		// Redirecting
		if	(isset($haciaperfilid))	{
			return	redirect()->route('profile',	['id'	=>	$haciaperfilid])->with([
															'message'	=>	'Comentario añadido'
			]);
		}	else	{
			return	redirect()->route('image.detail',	['id'	=>	$image_id])->with([
															'message'	=>	'Comentario añadido'
			]);
		}
	}

	public	function	delete($id)	{	// Id del comentario
		// Recoger o conseguir datos del usuario identificado
		$user	=	\Auth::user();

		// Conseguir objeto del comentrio
		$comment	=	Comment::find($id);

		// Comprobar si soy el dueño del comentario o de la publicación
		if	($user	&&	$comment->user_id	==	$user->id	||	$comment->image->user_id	==	$user->id)	{
			// Borramos el comentario
			$comment->delete();
			// Redirigir
			return	redirect()->route('image.detail',	['id'	=>	$comment->image->id])
																			->with([
																							'message'	=>	'Comentario borrado'
			]);
		}	else	{
			// Redirigir
			return	redirect()->route('image.detail',	['id'	=>	$comment->image->id])
																			->with([
																							'message'	=>	'El comentario no se la eliminado'
			]);
		}
	}

}
