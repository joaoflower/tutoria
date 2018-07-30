<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\Sesindi17Request;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Evalses;
use tutoria\Sesindi;
use tutoria\Sesindi17;
use tutoria\Estugrupo;
use tutoria\Itemproblema;
use tutoria\Areaproblema;
use tutoria\Itemreferido;
use Laracasts\Flash\Flash;


class InfoestuController extends Controller
{
	private $ano_aca = '2018';
	private $per_aca = '01';
    private $grupo;
    private $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();        
        $this->name = Auth::user()->name;
    }
    public function index(Request $request) {
        return view('infoestu.index')->with('grupo', $this->grupo);
	}
    public function viewInfo(Request $request, $num_mat) {
        if($request->ajax()) {
            $estudiante = null;
            $estumat = null;
            $estugrupos = null;
            $docente = null;
            $sesindi17 = null;
            $encusati = null;

            # Obtener estudiante
            //$estudiante = Estudiante::select('num_mat', 'cod_car', 'paterno', 'materno', 'nombres')->where('num_mat', $num_mat)->first();    
            $estudiante = Estudiante::getEstudiante($num_mat);
            $estumat = Estumat::select('num_mat', 'cod_car', 'niv_est')->where('num_mat', $num_mat)->where('per_aca', $this->per_aca)->first();  
        
            if($estumat != null) {
                # Obteniendo la sesion Individual y cod_prf
                $estugrupos = Estugrupo::where('num_mat', $num_mat)->where('cod_car', $estumat->cod_car)
                    ->with(['grupo' => function($query) {
                        $query->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca);
                    }, 'sesindi17s'])->get();  

                foreach ($estugrupos as $eg) {
                    if($eg->grupo != null) {
                        $docente = Docente::getName($eg->grupo->cod_prf);
                        foreach ($eg->sesindi17s as $si17) {
                            $sesindi17 = $si17;
                            foreach ($si17->encusatis as $es) {
                                $encusati = $es;
                            }
                        }
                    }
                }
            }
            
            return view('infoestu.view')
                ->with('estudiante', $estudiante)
                ->with('estumat', $estumat)
                ->with('docente', $docente)
                ->with('sesindi17', $sesindi17)
                ->with('encusati', $encusati);
        }
    }
    public function addTutor(Request $request, $num_mat) {
        if($request->ajax()) {
            # Add tutor
            $estumat = Estumat::select('num_mat', 'cod_car', 'niv_est')->where('num_mat', $num_mat)->where('per_aca', $this->per_aca)->first(); 
            $estugrupo = new Estugrupo();
            $estugrupo->grupo_id = $this->grupo->id;
            $estugrupo->num_mat = $num_mat;
            $estugrupo->cod_car = $estumat->cod_car;
            $estugrupo->save();
            #----------
            return $this->viewInfo($request, $num_mat);
        }
    }
    public function create() {

    }
    public function store(Request $request, $id) {     
        
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
