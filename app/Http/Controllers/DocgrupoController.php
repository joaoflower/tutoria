<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Estugrupo;
use tutoria\Docente;
use tutoria\Tutorado;
use tutoria\Tutor;
use tutoria\Carrera;

class DocgrupoController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '02';
    private $tutorado;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tutorado = Tutorado::find(Auth::user()->codigo);
    }
    public function index(Request $request) {
        if($this->tutorado != null) {
            $estugrupos = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)
                ->with(['grupo' => function($query) {
                    $query->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca);
                }])->get();

            $cod_prf  = "";
            foreach ($estugrupos as $eg) {
                if($eg->grupo != null) {
                    $cod_prf = $eg->grupo->cod_prf;
                }
            }
     
            if($cod_prf != null) { 
                $tutor = Tutor::find($cod_prf);
                if($tutor != null) {            
                    $carrera = Carrera::select('car_des')->where('cod_car', $tutor->cod_car)->first();
                    return view('perfild.index')
                        ->with('tutor', $tutor)
                        ->with('carrera', $carrera);
                } else {     
                    $docente = Docente::getDocente($cod_prf);
                    $docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;

                    return view('docgrupo.index')
                        ->with('docente', $docente);
                }
            }
            return view('nohaydoc');
        } else {
            return redirect()->route('perfile.create');
        }
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
