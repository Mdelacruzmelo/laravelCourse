<?php

namespace	App;

use	Illuminate\Database\Eloquent\Model;

class	Image	extends	Model	{

	protected	$table	=	'images';

	// Relación 1 to many
	// Un solo modelo va a tener varios comentarios
	// Nos va a sacar todos los comntarios que tenemos asignaa a una imagen
	public	function	comments()	{
		return	$this->hasMany('App\Comment')->orderBy('id','desc');	//Con que objeto quiero que esto trabaje
		//Esto me hace que mediante el id de imagen que hay guardada en comentario, hara la magia y nos conseguira cuando llamamos a comment el array de objeto de los comentario
		// EN RESUMEN - Cuando llame a imagen, llamara al metodo comment e interectuara con la otra entidad, vera que tengo un id guardado de la imagen  me va a sacar el array de todos los comentarios
	}

	// Relacion 1 to Many
	public	function	likes()	{
		return	$this->hasMany('App\Like');
		//Esto me sacara un array de objetos con todos los likes solo de la imagen que quiero sacar
	}

	// Relacion de Muchos a 1 / Many to One
	public	function	user()	{
		return	$this->belongsTo('App\User',	'user_id');	// El user_id es el campo de este objeto Image y la voy a relacionar con el objeto de Usuario con 'App\User'
		// Es decir, belongsTo se encarga de buscar en 'App\User' los objetos cuyo id sea igual a user_id de esta entidad
	}

}
