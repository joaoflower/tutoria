<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use tutoria\User;
use tutoria\Carrera;
use tutoria\Docente;

use tutoria\Http\Requests\UserRequest;
use tutoria\Http\Requests\UserEditRequest;
use Laracasts\Flash\Flash;

class UsututController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '01';

    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index(Request $request) {
    	$usuheads = User::getHeads();

    	return view('usutut.index')
            ->with('usuheads', $usuheads);
	} 
    public function create() {
    	$carreras = Carrera::lists('car_des', 'cod_car');
    	return view('usutut.create')
    		->with('carreras', $carreras);

    }
    public function getDocentes(Request $request, $cod_car) {
    	if($request->ajax()) {
    		$docentes = Docente::getDocentes($cod_car);
    		return response()->json($docentes);
    	}
    }
    public function store(UserRequest $request) {        
        $usunew = new User($request->all());

        $usunew->name = Docente::getName($request->codigo);
        $usunew->type = 'head';
        $usunew->password = bcrypt($request->password);
        $usunew->save();

        Flash::success('Se ha guardado el usuario de forma satisfactoria !');

        return redirect()->route('usutut.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	$usuhead = User::find($id);
        $usuhead->car_des = Carrera::getCarrera($usuhead->cod_car)->car_des;
        
        return view('usutut.edit')
         	->with('usuhead', $usuhead);
    }
    public function update(UserEditRequest $request, $id) {
        $usuhead = User::find($id);
        $usuhead->fill($request->all());
        $usuhead->password = bcrypt($request->password);
        $usuhead->save();

        Flash::warning('Se ha editado el usuario de forma exitosa');
        return redirect()->route('usutut.index');
    }
    public function destroy($id) {
    	$usuhead = User::find($id);
        $usuhead->delete();

        Flash::error('Se ha borrado el usuario de forma exitosa');
        return redirect()->route('usutut.index');
    }
}
