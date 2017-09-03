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
	#------------Grupo----------------------------
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

	Route::get('grupo/{id}/drop', 'GrupoController@dropGrupo');
	Route::get('grupo/{id}/{num_mat}/addestudiante', 'GrupoController@addEstugrupo');
	Route::get('grupo/{grupo_id}/{id}/dropestudiante', 'GrupoController@delEstugrupo');

	Route::get('grupot/tutortutorado', 'GrupoController@tutorTutorado')->name('grupot.tutortutorado');
	#-----------------------------------------------------------------------
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
	Route::get('sesindi17/{id}/drop', 'Sesindi17Controller@dropSesindi17');

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
	#----------- Usuarios----------------
	Route::resource('usutut', 'UsututController');
	Route::get('usutut/{id}/destroy', [
		'uses'	=> 'UsututController@destroy',
		'as'	=> 'usutut.destroy'
		]);
	Route::get('usutut/{cod_car}/docentes', 'UsututController@getDocentes');
	Route::post('usututc/storecoordinador', 'UsututController@storeCoordinador')->name('usututc.storecoordinador');
	Route::post('usututc/dropcoordinador', 'UsututController@dropCoordinador')->name('usututc.dropcoordinador');
	Route::post('usututc/getcoordinador', 'UsututController@getCoordinador')->name('usututc.getcoordinador');
	Route::post('usututc/updatecoordinador', 'UsututController@updateCoordinador')->name('usututc.updatecoordinador');
	#-----------------------------------------------------

	Route::resource('encusati', 'EncusatiController');
	Route::get('encusati/{id}/destroy', [
		'uses'	=> 'EncusatiController@destroy',
		'as'	=> 'encusati.destroy'
		]);

	Route::resource('sesuna', 'SesunaController');
	Route::get('sesuna/{id}/destroy', [
		'uses'	=> 'SesunaController@destroy',
		'as'	=> 'sesuna.destroy'
		]);
	Route::resource('singrupo', 'SingrupoController');
	Route::get('singrupo/{id}/destroy', [
		'uses'	=> 'SingrupoController@destroy',
		'as'	=> 'singrupo.destroy'
		]);

	Route::resource('infoestu', 'InfoestuController');
	Route::get('infoestu/{num_mat}/viewinfo', 'InfoestuController@viewInfo');
	Route::get('infoestu/{num_mat}/addtutor', 'InfoestuController@addTutor');
	#-------------------Plan----------------------
	Route::resource('plan', 'PlanController');
	Route::post('plan2', [
		'uses'	=>	'PlanController@store2',
		'as'	=>	'plan.store2'
		]);
	Route::post('plan3', [
		'uses'	=>	'PlanController@store3',
		'as'	=>	'plan.store3'
		]);
	Route::post('plan4', [
		'uses'	=>	'PlanController@store4',
		'as'	=>	'plan.store4'
		]);

	Route::post('plane/updateevaluacion', 'PlanController@updateEvaluacion')->name('planc.updateevaluacion');

	Route::get('planc/cronograma', 'PlanController@createCronograma')->name('plan.cronograma');
	Route::get('planc/{objetivo}/addobjetivo', 'PlanController@addObjetivo');	

	Route::post('planc/storeobjetivo', 'PlanController@storeObjetivo')->name('planc.storeobjetivo');
	Route::post('planc/updateobjetivo', 'PlanController@updateObjetivo')->name('planc.updateobjetivo');
	Route::post('planc/storeactividad', 'PlanController@storeActividad')->name('planc.storeactividad');
	Route::post('planc/getactividad', 'PlanController@getActividad')->name('planc.getactividad');
	Route::post('planc/updateactividad', 'PlanController@updateActividad')->name('planc.updateactividad');
	#---------------------------------------------------
	Route::resource('seguimiento', 'SeguimientoController');

	Route::resource('perfile', 'TutoradoController');
	Route::post('perfile2', [
		'uses'	=>	'TutoradoController@store2',
		'as'	=>	'perfile.store2'
		]);
	# POST 	/photos 	store 	photos.store

	Route::resource('perfild', 'TutorController');

	/*Route::get('grupo/{id}/{num_mat}/tutorado', 'GrupoController@addEstugrupo');
	Route::get('grupo/{grupo_id}/{id}/deltutorado', 'GrupoController@delEstugrupo');*/

#});



