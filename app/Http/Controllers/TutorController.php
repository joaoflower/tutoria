<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Tutor;
use tutoria\Docente;
use tutoria\Carrera;

class TutorController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '02';
    private $tutor;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tutor = Tutor::find(Auth::user()->codigo);
    }
    public function index(Request $request) {
        if($this->tutor != null) {            
            $carrera = Carrera::select('car_des')->where('cod_car', Auth::user()->cod_car)->first();
            return view('perfild.index')
                ->with('tutor', $this->tutor)
                ->with('carrera', $carrera);
        } else {     
            return redirect()->route('perfild.create');            
        }
	}
    public function create() {
        $tutor = new Tutor();
        return view('perfild.create')->with('tutor', $tutor);
    }
    public function store(Request $request) {   
        if($this->tutor != null) {
            # Buscando y actualizando 
            $tutor = Tutor::find(Auth::user()->codigo);
            $tutor->fill($request->all());        
            $tutor->save();
        } else {
            # Obtenido datos del docente
            $docente = Docente::select('cod_prf', 'cod_car', 'paterno', 'materno', 'nombres')
                ->where('cod_prf', Auth::user()->codigo)->first();
            # creando el tutorado
            $tutor = new Tutor($request->all());  
            $tutor->cod_prf = $docente->cod_prf;
            $tutor->cod_car = $docente->cod_car;
            $tutor->paterno = $docente->paterno;
            $tutor->materno = $docente->materno;
            $tutor->nombres = $docente->nombres;            

            $tutor->save();
        }
        return redirect()->route('perfild.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	if($this->tutor != null) {
            return view('perfild.create')->with('tutor', $this->tutor);
        } else {
            return redirect()->route('perfild.create');
        } 
    }
    public function update(Request $request, $id) {
    	
    }
}
