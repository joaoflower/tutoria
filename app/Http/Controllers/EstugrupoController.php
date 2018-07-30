<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Carrera;
use tutoria\Tutor;
use tutoria\Tutorado;
use tutoria\Estugrupo;
use tutoria\Esturiesgo;

class EstugrupoController extends Controller
{
    private $ano_aca = '2018';
	private $per_aca = '01';
    private $tutor;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tutor = Tutor::find(Auth::user()->codigo);
    }
    public function index(Request $request) {
        if($this->tutor != null) {
            $grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
            if($grupo != null) { 
                if($grupo->estugrupos->count() > 0) {
                    $estugrupos = $grupo->estugrupos;
                    $estugrupos->each(function($estugrupo) { 

                        $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
                        $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;

                        $estugrupo->car_des = $estugrupo->estu->car_des;
                        # Estudiantes en riesgo
                        $riesgo = Esturiesgo::find($estugrupo->num_mat);
                        if($riesgo == null) {
                            $estugrupo->riesgo = false;
                        } else {
                            $estugrupo->riesgo = true;
                        }                        
                    });
                    $estugrupos = $estugrupos->sortBy(function($estugrupo) {
                        return $estugrupo->name;
                    });
                    return view('estugrupo.index')->with('estugrupos', $estugrupos);
                }
            }
            return view('nohayestu');
    	} else {
            return redirect()->route('perfild.create');
        }
	}
    public function create() {
    	
    }
    public function store(SesindiRequest $request) {
    	
    }
    private function myTutorado($num_mat, $cod_car) {
        $cod_prf = null;
        $estugrupos = Estugrupo::where('num_mat', $num_mat)->where('cod_car', $cod_car)
            ->with(['grupo' => function($query) {
                $query->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca);
            }])->get();  
        foreach ($estugrupos as $eg) {
            if($eg->grupo != null) {
                $cod_prf = $eg->grupo->cod_prf;
            }
        }
        if(Auth::user()->codigo == $cod_prf) {
            return true;
        } else {
            return false;
        }
    }
    public function show($num_mat) {
        $tutorado = Tutorado::find($num_mat);
        if($tutorado != null) {
            if($this->myTutorado($tutorado->num_mat, $tutorado->cod_car)) {
                $tutorado->url = urlencode($tutorado->url);
                $estumat = Estumat::select('niv_est')->where('num_mat', $tutorado->num_mat)
                    ->where('cod_car', $tutorado->cod_car)->where('per_aca', $this->per_aca)
                    ->first();
                $carrera = Carrera::select('car_des')->where('cod_car', $tutorado->cod_car)->first();
                return view('perfile.index')
                    ->with('tutorado', $tutorado)
                    ->with('estumat', $estumat)
                    ->with('carrera', $carrera)
                    ->with('itemhabitos', $tutorado->itemhabitos)
                    ->with('itemhobbies', $tutorado->itemhobbies);
            } else {
                return redirect()->route('estugrupo.index');  
            }          
        }   
        return view('error')->with('error', 'No hay Perfil, debido a que el estudiante no actualizó su información ...!');         
    }
    public function edit($id) {
    	
    }
    public function update(Request $request, $id) {
    	
    }
    public function destroy($id) {
    	
    }
}
