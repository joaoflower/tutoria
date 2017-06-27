<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Grupo;
use tutoria\Estudiante;

class EstugrupoController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '01';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        $grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
        if($grupo != null) { 
            if($grupo->estugrupos->count() > 0) {
                $estugrupos = $grupo->estugrupos;
                $estugrupos->each(function($estugrupo) { 

                    $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
                    $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;

                    $estugrupo->car_des = $estugrupo->estu->car_des;

                    $estugrupo->induccion;

                    $estugrupo->sesindis;
                    $estugrupo->count_sesi = $estugrupo->sesindis->count();

                    $estugrupo->itadocs;
                    $estugrupo->count_itad = $estugrupo->itadocs->count();

                    $estugrupo->evaldoc; 
                });
                $estugrupos = $estugrupos->sortBy(function($estugrupo) {
                    return $estugrupo->name;
                });
                return view('estugrupo.index')->with('estugrupos', $estugrupos);
            }
        }
        return view('nohayestu');
    	
	}
    public function create() {
    	
    }
    public function store(SesindiRequest $request) {
    	
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
