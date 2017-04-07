<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\SesgruRequest;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Evalses;
use tutoria\Sesindi;
use tutoria\Sesgru;
use tutoria\Sesgruase;
use tutoria\Induccion;
use tutoria\Iteminduc;
use tutoria\Procinduc;
use Laracasts\Flash\Flash;

class SesgruController extends Controller
{
	private $ano_aca = '2016';
	private $per_aca = '02';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        $grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
        if($grupo != null) { 
            if($grupo->estugrupos->count() > 0) {
                $sesgrus = $grupo->sesgrus;

        	   return view('sesgru.index')->with('sesgrus', $sesgrus);
            }
        }
        return view('nohayestu');
	}
    public function create() {
    	//$docente = Docente::where('cod_prf', Auth::user()->codigo)->first();
     	//$docente->name = $docente->paterno.' '.$docente->materno.' '.$docente->nombres;
        $docente = Docente::getName(Auth::user()->codigo);

     	$grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();

     	$estugrupos = $grupo->estugrupos;
     	$estugrupos->each(function($estugrupo) {
            //$estugrupo->estumat->estudiante;
            //$estugrupo->name = $estugrupo->estumat->estudiante->paterno.' '.$estugrupo->estumat->estudiante->materno.' '.$estugrupo->estumat->estudiante->nombres;
            $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;
     	});
     	foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
     	}
     	$estudiantes = Collection::make($estu_tmp);   

     	$evalsess = Evalses::lists('name', 'id');

     	return view('sesgru.create')
            ->with('docente', $docente)
            ->with('grupo', $grupo)
            ->with('estudiantes', $estudiantes)
            ->with('evalsess', $evalsess);
    }
    public function store(SesgruRequest $request) {
    	$grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
    	$sesgru = new Sesgru($request->all());
    	$sesgru->grupo_id = $grupo->id;
    	
    	$count = Sesgru::where('grupo_id', $sesgru->grupo_id)->count();
        
        $sesgru->nro_ses = $count + 1;
        $sesgru->save();

        foreach ($request->asi_ests as $estugrupo_id => $asi_est) {
          	$sesgruase = new Sesgruase();
          	$sesgruase->sesgru()->associate($sesgru);
          	$sesgruase->estugrupo_id = $estugrupo_id;
          	$sesgruase->asi_est = $asi_est;
          	$sesgruase->evalses_id = $request->evalses_ids[$estugrupo_id];
          	$sesgruase->save();
        }
        Flash::success('Se ha guardado la sesión de forma satisfactoria !');

        return redirect()->route('sesgru.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        //$docente = Docente::where('cod_prf', Auth::user()->codigo)->first();
        //$docente->name = $docente->paterno.' '.$docente->materno.' '.$docente->nombres;
        $docente = Docente::getName(Auth::user()->codigo);

        $grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();

        $sesgru = Sesgru::find($id);

    	$estugrupos = $sesgru->grupo->estugrupos;
     	$estugrupos->each(function($estugrupo) {
            //$estugrupo->estumat->estudiante;
            //$estugrupo->name = $estugrupo->estumat->estudiante->paterno.' '.$estugrupo->estumat->estudiante->materno.' '.$estugrupo->estumat->estudiante->nombres;
            $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;
     	});
     	foreach ($estugrupos as $eg) {
         $estu_tmp[$eg->id] = $eg->name;
     	}
     	$estudiantes = Collection::make($estu_tmp); 

     	$asi_ests = array();
     	$evalses_ids = array();
     	foreach ($sesgru->sesgruases as $sesgruase) {
     		$asi_ests[$sesgruase->estugrupo_id] = $sesgruase->asi_est;
     		$evalses_ids[$sesgruase->estugrupo_id] = $sesgruase->evalses_id;
     	}

     	$evalsess = Evalses::lists('name', 'id');

     	return view('sesgru.edit')
         ->with('docente', $docente)
         ->with('grupo', $grupo)
         ->with('sesgru', $sesgru)
         ->with('estudiantes', $estudiantes)
         ->with('asi_ests', $asi_ests)
         ->with('evalses_ids', $evalses_ids)
         ->with('evalsess', $evalsess);

    }
    public function update(SesgruRequest $request, $id) {

    	$sesgru = Sesgru::find($id);
    	$sesgru->fill($request->all());
      $sesgru->save();

    	foreach ($sesgru->sesgruases as $sesgruase) {
    		$sesgruase->asi_est = $request->asi_ests[$sesgruase->estugrupo_id];
    		$sesgruase->evalses_id = $request->evalses_ids[$sesgruase->estugrupo_id];
    		$sesgruase->save();
    	}

    	Flash::success('Se ha editado la sesión de forma satisfactoria !');

      return redirect()->route('sesgru.index');
    }
    public function destroy($id) {
    	$sesgru = Sesgru::find($id);

     	foreach ($sesgru->sesgruases as $sesgruase ) {
         $sesgruase->delete();
     	}

     	$sesgru->delete();

     Flash::error('Se ha borrado la sesion de forma exitosa');
     return redirect()->route('sesgru.index');
    }
}
