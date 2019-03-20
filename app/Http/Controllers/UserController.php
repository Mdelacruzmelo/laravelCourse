<?php

namespace	App\Http\Controllers;

use	Illuminate\Http\Request;
use	Illuminate\Support\Facades\Storage;
use	Illuminate\Support\Facades\File;
use	Illuminate\Http\Response;
use	App\User;

class	UserController	extends	Controller	{

	public	function	__construct()	{
		$this->middleware('auth');
	}

	public	function	index($search	=	null)	{
		
		if	(!empty($search))	{
			$users	=	user::where('nick',	'LIKE',	'%'	.	$search	.	'%')
											->orWhere('name',	'LIKE',	'%'	.	$search	.	'%')
											->orWhere('surname',	'LIKE',	'%'	.	$search	.	'%')
											->orderBy('id',	'desc')
											->paginate(5);
		}	else	{
			$users	=	user::orderBy('id',	'desc')->paginate(5);
		}


		return	view('user.index',	['users'	=>	$users]);
	}

	public	function	config()	{
		return	view('user.config');
	}

	public	function	update(Request	$request)	{
		// Conseguir usuario identficado
		$user	=	\Auth::user();
		$id	=	$user->id;

		//Validacion del formulario
		$validate	=	$this->validate($request,	[
						'name'	=>	['required',	'string',	'max:255'],
						'surname'	=>	['required',	'string',	'max:255'],
						'nick'	=>	['required',	'string',	'max:255',	'unique:users,nick,'	.	$id],
						'email'	=>	['required',	'string',	'email',	'max:255',	'unique:users,email,'	.	$id]
		]);

		// Recoger los datos del formulario
		$name	=	$request->input('name');
		$surname	=	$request->input('surname');
		$nick	=	$request->input('nick');
		$email	=	$request->input('email');

		//Asignar nuevoss valores del objeto usuario
		$user->name	=	$name;
		$user->surname	=	$surname;
		$user->nick	=	$nick;
		$user->email	=	$email;

		// Subir la imagen
		$image_path	=	$request->file('image_path');
		if	($image_path)	{
			// Poniendole un nombre unico a la imagen que me llega
			$image_path_name	=	time()	.	$image_path->getClientOriginalName();	//Es el nombre de fichero original cuando sube el usuario
			// Usamos el metodo disk que me permite seleccionar el disco, y con esto la carpeta dentro de la carpeta storage que quiero usar para guardar la imagen. En este caso dentro de Users. Uso el metodo PUT  que me pide primero el nombre, y lo segundo es el fichero, para el fichero consifo el archivo en bruto el archivo final - EN RESUMEN: Lo que hace esto es copiar la imagen que he subido en la carpeta temproal donde se ha guardado, conseguir le fichero y con el PUT del storage ya me lo guarda dentro de la carpeta de users
			//Guardamos en la carpeta storage (storage/app/users))
			Storage::disk('users')->put($image_path_name,	File::get($image_path));

			//Setetar el nombre del archivo
			$user->image	=	$image_path_name;
		}

		// Ejecutar consulta y cambios en la BD
		$user->update();

		return	redirect()->route('config')->with([
														'message'	=>	'Usuario actualizado correctamente'
		]);
	}

	public	function	getImage($filename)	{
		$file	=	Storage::disk('users')->get($filename);
		// Me devuelve en un fortmato crudo para yo imprimirlo por pantalla
		return	new	Response($file,	200);
	}

	public	function	profile($id)	{
		$user	=	User::find($id);
		return	view('user.profile',	['user'	=>	$user]);
	}

}
