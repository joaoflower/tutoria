<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
#Route::group(['middleware' => ['web']], function () { 
	/*Route::get('/', function () {
	   return view('welcome');
	});*/

	//Route::auth();

	Route::get('login', [
		'uses'	=>	'Auth\AuthController@showLoginForm',
		'as'	=>	'auth.login'
		]);
	Route::post('signin', [
		'uses'	=>	'Auth\AuthController@signin',
		'as'	=>	'auth.signin'
		]);
	Route::get('logout', [
		'uses'	=>	'Auth\AuthController@logout',
		'as'	=>	'auth.logout'
		]);

	Route::get('/home', 'HomeController@index');

	//Route::get('/', 'TutoriaController@index');   
	Route::get('/', [
		'as'	=>	'front.index', function() {
			return view('front.index');
		}]);

	Route::get('index', [
		'uses'	=>	'TutoriaController@index',
		'as'	=>	'index']);
	Route::get('error', [
		'uses'	=>	'TutoriaController@error',
		'as'	=>	'error']);
	Route::get('nohayestu', [
		'uses'	=>	'TutoriaController@nohayEstu',
		'as'	=>	'nohayestu']);
	Route::get('nohaydoc', [
		'uses'	=>	'TutoriaController@nohayDoc',
		'as'	=>	'nohaydoc']);

	Route::resource('grupo', 'GrupoController'); 
	Route::get('grupo/{id}/createstu', [
		'uses'	=> 'GrupoController@createstu',
		'as'	=> 'grupo.createstu'
		]);
	Route::put('grupo/{id}/storestu', [
		'uses'	=> 'GrupoController@storestu',
		'as'	=> 'grupo.storestu'
		]);
	Route::get('grupo/{id}/destroy', [
		'uses'	=> 'GrupoController@destroy',
		'as'	=> 'grupo.destroy'
		]);
	/*Route::get('grupo/{id}/deltutorado', [
		'uses'	=> 'GrupoController@delEstugrupo',
		'as'	=> 'grupo.deltutorado'
		]);*/
	Route::get('grupo/{id}/induccion', [
		'uses'	=> 'GrupoController@showInduccion',
		'as'	=> 'grupo.induccion'
		]);
	Route::get('grupo/{id}/sesindi', [
		'uses'	=> 'GrupoController@showSesindi',
		'as'	=> 'grupo.sesindi'
		]);
	Route::get('grupo/{id}/itadoc', [
		'uses'	=> 'GrupoController@showItadoc',
		'as'	=> 'grupo.itadoc'
		]);
	Route::get('grupo/{id}/evaldoc', [
		'uses'	=> 'GrupoController@showEvaldoc',
		'as'	=> 'grupo.evaldoc'
		]);
	Route::get('grupo/{id}/sesgru', [
		'uses'	=> 'GrupoController@showSesgru',
		'as'	=> 'grupo.sesgru'
		]);
	Route::get('getcar', [
		'uses'	=> 'GrupoController@getCar',
		'as'	=> 'grupo.getcar'
		]);
	Route::post('setcar', [
		'uses'	=> 'GrupoController@setCar',
		'as'	=> 'grupo.setcar'
		]);
	Route::get('grupo/{id}/{num_mat}/tutorado', 'GrupoController@addEstugrupo');
	Route::get('grupo/{grupo_id}/{id}/deltutorado', 'GrupoController@delEstugrupo');

	Route::resource('estugrupo', 'EstugrupoController');

	Route::resource('docgrupo', 'DocgrupoController');

	Route::resource('induccion', 'InduccionController');
	Route::get('induccion/{id}/destroy', [
		'uses'	=> 'InduccionController@destroy',
		'as'	=> 'induccion.destroy'
		]);

	Route::resource('sesindi', 'SesindiController');
	Route::get('sesindi/{id}/destroy', [
		'uses'	=> 'SesindiController@destroy',
		'as'	=> 'sesindi.destroy'
		]);

	Route::resource('sesindi17', 'Sesindi17Controller');
	Route::get('sesindi17/{id}/destroy', [
		'uses'	=> 'Sesindi17Controller@destroy',
		'as'	=> 'sesindi17.destroy'
		]);

	Route::resource('sesgru', 'SesgruController');
	Route::get('sesgru/{id}/destroy', [
		'uses'	=> 'SesgruController@destroy',
		'as'	=> 'sesgru.destroy'
		]);

	Route::resource('itaestu', 'ItaestuController');
	Route::get('itaestu/{id}/destroy', [
		'uses'	=> 'ItaestuController@destroy',
		'as'	=> 'itaestu.destroy'
		]);

	Route::resource('itadoc', 'ItadocController');
	Route::get('itadoc/{id}/destroy', [
		'uses'	=> 'ItadocController@destroy',
		'as'	=> 'itadoc.destroy'
		]);

	Route::resource('evalestu', 'EvalestuController');
	Route::get('evalestu/{id}/destroy', [
		'uses'	=> 'EvalestuController@destroy',
		'as'	=> 'evalestu.destroy'
		]);
	Route::resource('evaldoc', 'EvaldocController');
	Route::get('evaldoc/{id}/destroy', [
		'uses'	=> 'EvaldocController@destroy',
		'as'	=> 'evaldoc.destroy'
		]);
	Route::resource('usutut', 'UsututController');
	Route::get('usutut/{id}/destroy', [
		'uses'	=> 'UsututController@destroy',
		'as'	=> 'usutut.destroy'
		]);
	Route::get('usutut/{cod_car}/docentes', 'UsututController@getDocentes');

	Route::resource('encusati', 'EncusatiController');
	Route::get('encusati/{id}/destroy', [
		'uses'	=> 'EncusatiController@destroy',
		'as'	=> 'encusati.destroy'
		]);
#});



