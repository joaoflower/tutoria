<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\EvaldocRequest;
use tutoria\Mesita;
use tutoria\Grupo;
use tutoria\Estugrupo;
use tutoria\Itemevaldoc;
use tutoria\Evaldoc;
use tutoria\Estudiante;
use tutoria\Docente;
use Laracasts\Flash\Flash;

class EvaldocController extends Controller
{
    private $ano_aca = '2016';
	private $per_aca = '02';
	private $grupo;
	private $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();        
    	$this->name = Docente::getName(Auth::user()->codigo);
    }
    public function index(Request $request) {
        if($this->grupo != null) { 
            if($this->grupo->estugrupos->count() > 0) { 
                $estugrupos = $this->grupo->estugrupos;

            	$estugrupos->each(function($estugrupo) {
            		if($estugrupo->evaldoc != null) {
            			$estugrupo->evaldoc->itemevaldocs->each(function($itemevaldoc) {
            				$itemevaldoc->escala += $itemevaldoc->pivot->escala;
            			});
            		}

            		//$estugrupo->name = $estugrupo->estumat->estudiante->paterno.' '.$estugrupo->estumat->estudiante->materno.', '.$estugrupo->estumat->estudiante->nombres;
                    $estugrupo->name = Estudiante::getName($estugrupo->num_mat);
            	});

            	return view('evaldoc.index')
                    ->with('estugrupos', $estugrupos);
            }
        }
        return view('error')->with('error', 'No tiene tutorados asignados ...!');
	} 
    public function create() {
    	$estugrupos = $this->grupo->estugrupos;
    	$docente = $this->name;

    	$estugrupos->each(function($estugrupo) {
    		//$estugrupo->estumat->estudiante;
            //$estugrupo->name = $estugrupo->estumat->estudiante->paterno.' '.$estugrupo->estumat->estudiante->materno.' '.$estugrupo->estumat->estudiante->nombres;
            $estugrupo->name = Estudiante::getName($estugrupo->num_mat);
    	});
    	foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
		}
		$estudiantes = Collection::make($estu_tmp);

		$itemevaldocs = Itemevaldoc::where('enable', true)->get();

		return view('evaldoc.create')
        	->with('docente', $docente)
         	->with('estudiantes', $estudiantes)
         	->with('itemevaldocs', $itemevaldocs);
    }
    public function store(EvaldocRequest $request) {
        $evaldoc_item = array();
        foreach ($request->evaldoc_item as $itemeval_id => $escala) {
            $evaldoc_item[$itemeval_id] = ['escala' => $escala];
        }

        $evaldoc = new Evaldoc($request->all());
        $evaldoc->save();

        $evaldoc->itemevaldocs()->sync($evaldoc_item);

        Flash::success('Se ha guardado la evaluación de forma satisfactoria !');

        return redirect()->route('evaldoc.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	$evaldoc = Evaldoc::find($id);
        $docente = $this->name;        

        //$estudiante = $evaldoc->estugrupo->estumat->estudiante;
        //$estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;
         $estudiante = Estudiante::getName($evaldoc->estugrupo->num_mat);

        $evaldoc_item = array();
        foreach ($evaldoc->itemevaldocs as $itemevaldoc ) {
            $evaldoc_item[$itemevaldoc->pivot->itemeval_id] = $itemevaldoc->pivot->escala;
        }

        $itemevaldocs = Itemevaldoc::where('enable', true)->get();

        return view('evaldoc.edit')
     		->with('evaldoc', $evaldoc)
        	->with('docente', $docente)
         	->with('estudiante', $estudiante)
         	->with('itemevaldocs', $itemevaldocs)
         	->with('evaldoc_item', $evaldoc_item);

    }
    public function update(EvaldocRequest $request, $id) {
    	$evaldoc_item = array();
        foreach ($request->evaldoc_item as $itemeval_id => $escala) {
            $evaldoc_item[$itemeval_id] = ['escala' => $escala];
        }

        $evaldoc = Evaldoc::find($id);
        $evaldoc->fill($request->all());
        $evaldoc->save();

        $evaldoc->itemevaldocs()->sync($evaldoc_item);

        Flash::warning('Se ha editado la evaluación de forma exitosa');
        return redirect()->route('evaldoc.index');
    }
    public function destroy($id) {
    	$evaldoc = Evaldoc::find($id);

        foreach ($evaldoc->itemevaldocs as $itemevaldoc ) {
            $itemevaldoc->pivot->delete();
        }

        $evaldoc->delete();

        Flash::error('Se ha borrado la evaluación de forma exitosa');
        return redirect()->route('evaldoc.index');
    }
}
