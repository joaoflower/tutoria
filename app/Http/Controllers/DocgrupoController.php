<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Estugrupo;
use tutoria\Docente;

class DocgrupoController extends Controller
{
    private $ano_aca = '2016';
	private $per_aca = '02';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
    	$estugrupo = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();
        if($estugrupo != null) { 
        	//$docente = $estugrupo->grupo->docente;
            $docente = Docente::getDocente($estugrupo->grupo->cod_prf);
            $docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;
            $docente->estugrupo_id = $estugrupo->id;
            $evalestu = $estugrupo->evalestu;

            return view('docgrupo.index')
            	->with('docente', $docente)
            	->with('evalestu', $evalestu);
        }
        return view('error')->with('error', 'No tiene Tutor asignado ...!');
	}
    public function create() {
    	
    }
    public function store(Request $request) {
    	
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	
    }
    public function update(Request $request, $id) {
    	
    }
    public function destroy($id) {
    	
    }
}
