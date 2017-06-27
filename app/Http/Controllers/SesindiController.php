<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\SesindiRequest;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Evalses;
use tutoria\Sesindi;
use Laracasts\Flash\Flash;


class SesindiController extends Controller
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
                $sesindi = null;
                $count = 0;
                foreach ($grupo->estugrupos as $eg) {
                    $sesindi[$count] = Sesindi::where('estugrupo_id',$eg->id);
                    $count++;
                }
                $sesindis = null;
                if($count > 0) {
                    $query = $sesindi[0];
                    for($ii = 1; $ii < $count; $ii++) {
                        $query = $query->union($sesindi[$ii]);
                    }
                    $sesindis = $query->get();
                }
                $sesindis->each(function($sesindi) {
                    $sesindi->estugrupo;
                    //$sesindi->num_mat = $sesindi->estugrupo->estumat->num_mat;
                    //$sesindi->name = $sesindi->estugrupo->estumat->estudiante->paterno.' '.$sesindi->estugrupo->estumat->estudiante->materno.', '.$sesindi->estugrupo->estumat->estudiante->nombres;
                    $sesindi->estu = Estudiante::getEstudiante($sesindi->estugrupo->num_mat);
                    $sesindi->num_mat = $sesindi->estugrupo->num_mat;
                    $sesindi->name = $sesindi->estu->paterno.' '.$sesindi->estu->materno.', '.$sesindi->estu->nombres;
                });

                $sesindis = $sesindis->sortBy(function($sesindi) {
                    return $sesindi->name.$sesindi->nro_ses.$sesindi->fecha;
                });

            	return view('sesindi.index')->with('sesindis', $sesindis);
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
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.' '.$estugrupo->estu->nombres;
    	});

    	foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
		}
		$estudiantes = Collection::make($estu_tmp);   	

		$evalsess = Evalses::lists('name', 'id');

    	return view('sesindi.create')
            ->with('docente', $docente)
            ->with('estudiantes', $estudiantes)
            ->with('evalsess', $evalsess);
    }
    public function store(SesindiRequest $request) {
        $sesindi = new Sesindi($request->all());
        
        $count = Sesindi::where('estugrupo_id', $sesindi->estugrupo_id)->count();
        
        $sesindi->nro_ses = $count + 1;
    	$sesindi->save();

    	Flash::success('Se ha guardado la Ficha N° 2 de forma satisfactoria !');

    	return redirect()->route('sesindi.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        //$docente = Docente::where('cod_prf', Auth::user()->codigo)->first();
        //$docente->name = $docente->paterno.' '.$docente->materno.' '.$docente->nombres;
        $docente = Docente::getName(Auth::user()->codigo);

    	$sesindi = Sesindi::find($id);
        //$sesindi->estugrupo;
        //$sesindi->num_mat = $sesindi->estugrupo->estumat->num_mat;
        //$sesindi->name = $sesindi->estugrupo->estumat->estudiante->paterno.' '.$sesindi->estugrupo->estumat->estudiante->materno.', '.$sesindi->estugrupo->estumat->estudiante->nombres;
        $sesindi->estu = Estudiante::getEstudiante($sesindi->estugrupo->num_mat);
        $sesindi->num_mat = $sesindi->estugrupo->num_mat;
        $sesindi->name = $sesindi->estu->paterno.' '.$sesindi->estu->materno.', '.$sesindi->estu->nombres;

        $evalsess = Evalses::lists('name', 'id');

        return view('sesindi.edit')
            ->with('docente', $docente)
            ->with('sesindi', $sesindi)
            ->with('evalsess', $evalsess);
    }
    public function update(Request $request, $id) {

    	$sesindi = Sesindi::find($id);
        $sesindi->fill($request->all());

        $sesindi->save();

        Flash::warning('Se ha editado la sesión  de forma exitosa');
        return redirect()->route('sesindi.index');
    }
    public function destroy($id) {
    	$sesindi = Sesindi::find($id);
        $sesindi->delete();

        Flash::error('Se ha borrado la sesión de forma exitosa');
        return redirect()->route('sesindi.index');
    }
}
