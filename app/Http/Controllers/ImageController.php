<?php

namespace	App\Http\Controllers;

use	Illuminate\Http\Request;
use	Illuminate\Support\Facades\Storage;	// Con eso puedo crear objetos
use	Illuminate\Support\Facades\File;	// Con eso puedo crear objetos
use	Illuminate\Http\Response;
use	App\Image;
use	App\Comment;
use	App\Like;

class	ImageController	extends	Controller	{

	public	function	__construct()	{
		$this->middleware('auth');
	}

	public	function	create()	{
		return	view('image.create');
	}

	public	function	save(Request	$request)	{
		//Validation
		$validate	=	$this->validate($request,	[
						'description'	=>	['required'],
						'image_path'	=>	['required',	'image',	'mimes:jpg,jpeg,png,gif']
		]);

		// Recoger datos
		$image_path	=	$request->file('image_path');
		$description	=	$request->input('description');

		// Setear el id del usuario que crea la imagen
		$user	=	\Auth::user();

		// Asignar valores al objeto
		$image	=	new	Image;
		$image->user_id	=	$user->id;
		$image->description	=	$description;

		// Subir fichero
		if	($image_path)	{
			$image_path_name	=	time()	.	$image_path->getClientOriginalName();
			Storage::disk('images')->put($image_path_name,	File::get($image_path));
			$image->image_path	=	$image_path_name;
		}

		$image->save();
		return	redirect()->route('home')->with([
														'message'	=>	'Imagen añadida correctamente'
		]);
	}

	public	function	getImage($filename)	{
		$file	=	Storage::disk('images')->get($filename);
		return	new	Response($file,	200);
	}

	public	function	detail($id)	{
		$image	=	Image::find($id);
		return	view('image.detail',	[
						'image'	=>	$image
		]);
	}

	public	function	delete($id)	{
		$user	=	\Auth::user();
		$image	=	Image::find($id);
		$comments	=	Comment::where('image_id',	$id)->get();
		$likes	=	Like::where('image_id',	$id)->get();

		if	($user	&&	$image	&&	$image->user->id	==	$user->id)	{
			// Eliminar Comentario
			if	($comments	&&	count($comments)	>=	1)	{
				foreach	($comments	as	$comment)	{
					$comment->delete();
				}
			}
			// Eliminar los likes
			if	($likes	&&	count($likes)	>=	1)	{
				foreach	($likes	as	$like)	{
					$like->delete();
				}
			}
			// Eliminar ficheros de imagen
			Storage::disk('images')->delete($image->image_path);
			//// El campo de la base de datos se llama image_path
			// Eliminar registro imagen
			$image->delete();
			$message	=	array('message'	=>	'La imagen se ha borrado exitosamente');
		}	else	{
			$message	=	array('message'	=>	'La imagen no se ha borrado');
		}
		return	redirect()->route('home')->with($message);
	}

	public	function	edit($id)	{
		$user	=	\Auth::user();
		$image	=	Image::find($id);
		if	($user	&&	$image	&&	$image->user->id	==	$user->id)	{
			return	view('image.edit',	[
							'image'	=>	$image
			]);
		}	else	{
			return	redirect()->route('home');
		}
	}

	public	function	update(Request	$request)	{
		//Validation
		$validate	=	$this->validate($request,	[
						'description'	=>	['required'],
						'image_path'	=>	'image'
		]);

// Recoger datos
		$image_id	=	$request->input('image_id');
		$description	=	$request->input('description');
		$image_path	=	$request->file('image_path');

		// Asignar valores al objeto
		$image	=	Image::find($image_id);
		$image->description	=	$description;

		// Subir fichero
		if	($image_path)	{
			$image_path_name	=	time()	.	$image_path->getClientOriginalName();
			Storage::disk('images')->put($image_path_name,	File::get($image_path));
			$image->image_path	=	$image_path_name;
		}

		// Actualizar el registro
		$image->update();

		// Redirigir
		return	redirect()->route('image.detail',	['id'	=>	$image_id])->with(['message'	=>	'Imagen actualziada con éxito']);
	}

}
