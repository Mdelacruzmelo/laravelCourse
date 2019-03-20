<?php

/*
	 |--------------------------------------------------------------------------
	 | Web Routes
	 |--------------------------------------------------------------------------
	 |
	 | Here is where you can register web routes for your application. These
	 | routes are loaded by the RouteServiceProvider within a group which
	 | contains the "web" middleware group. Now create something great!
	 |
	*/

//use	App\Image;

/*
	 Route::get('/',	function	()	{

	 $images	=	Image::all();
	 foreach	($images	as	$image)	{
	 echo	'<h4>'	.	$image->image_path	.	'</h4><br>';
	 echo	$image->description	.	'<br>';
	 // Puedo mostrar tranquilamente los datos del usuario
	 echo	$image->user->name	.	' '	.	$image->user->surname	.	'<br>';
	 echo	"<strong>Comentarios :</strong><br><br>";
	 foreach	($image->comments	as	$comment)	{
	 echo	$comment->user->name	.	' '	.	$comment->user->surname	.	': ';
	 echo	$comment->content	.	'<br>';
	 }
	 echo	'<hr>';
	 echo	'Likes: '	.	count($image->likes);

	 echo	'<hr>';
	 }

	 die();
	 return	view('welcome');
	 }); */


Route::get('/',	function	()	{
	return	view('welcome');
});

// Rutas Generales
Auth::routes();
Route::get('/',	'HomeController@index')->name('home');

// Rutas para usuario
Route::get('/config',	'UserController@config')->name('config');
Route::post('/user/update',	'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}',	'UserController@getImage')->name('user.avatar');
Route::get('profile/{id}',	'UserController@profile')->name('profile');
Route::get('/gente/{search?}',	'UserController@index')->name('index');

// Rutas para imagen
Route::get('/subir-imagen',	'ImageController@create')->name('image.create');
Route::post('/image/update',	'ImageController@update')->name('image.update');
Route::get('/image/delete/{id}',	'ImageController@delete')->name('image.delete');
Route::get('/image/editar/{id}',	'ImageController@edit')->name('image.edit');
Route::get('/image/{id}',	'ImageController@detail')->name('image.detail');
Route::post('/imagen-save',	'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}',	'ImageController@getImage')->name('image.file');

// Rutas para los comentarios
Route::post('/comment/save',	'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}',	'CommentController@delete')->name('comment.delete');

// Rutas para los likes
Route::get('/like/{image_id}',	'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}',	'LikeController@dislike')->name('like.delete');
Route::get('likes',	'LikeController@index')->name('likes');
