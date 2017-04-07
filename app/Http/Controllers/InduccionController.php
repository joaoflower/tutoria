<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\InduccionRequest;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Evalses;
use tutoria\Sesindi;
use tutoria\Induccion;
use tutoria\Iteminduc;
use tutoria\Procinduc;
use Laracasts\Flash\Flash;

class InduccionController extends Controller
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
                $induccion = null;
                $count = 0;
                foreach ($grupo->estugrupos as $eg) {
                    $induccion[$count] = Induccion::where('estugrupo_id',$eg->id);
                    $count++;
                }

                $inducciones = null;
                if($count > 0) {
                    $query = $induccion[0];
                    for($ii = 1; $ii < $count; $ii++) {
                        $query = $query->union($induccion[$ii]);
                    }
                    $inducciones = $query->get();
                }
                $inducciones->each(function($induccion) {
                    $induccion->estugrupo;
                    $induccion->estu = Estudiante::getEstudiante($induccion->estugrupo->num_mat);
                    $induccion->num_mat = $induccion->estugrupo->num_mat;
                    $induccion->name = $induccion->estu->paterno.' '.$induccion->estu->materno.', '.$induccion->estu->nombres;
                });

                $inducciones = $inducciones->sortBy(function($induccion) {
                    return $induccion->name;
                });

            	return view('induccion.index')->with('inducciones', $inducciones);
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
            $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.' '.$estugrupo->estu->nombres;
        });

        foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
        }
        $estudiantes = Collection::make($estu_tmp);   

        $iteminducs = Iteminduc::where('enable', true)->get();  
        $procinducs = Procinduc::where('enable', true)->get();  

        return view('induccion.create')
            ->with('docente', $docente)
            ->with('estudiantes', $estudiantes)
            ->with('iteminducs', $iteminducs)
            ->with('procinducs', $procinducs);
    }
    public function store(InduccionRequest $request) {
        $induccion_item = array();
        foreach ($request->eva_items as $item_id => $eva_ind) {
            $induccion_item[$item_id] = ['eva_ind' => $eva_ind];
        }
        $induccion_proc = array();
        foreach ($request->eva_procs as $proc_id => $eva_ind) {
            $induccion_proc[$proc_id] = ['eva_ind' => $eva_ind];
        }

        $induccion = new Induccion($request->all());
        $induccion->save();

        $induccion->iteminducs()->sync($induccion_item);
        $induccion->procinducs()->sync($induccion_proc);
        
        Flash::success('Se ha guardado la inducción de forma satisfactoria !');

        return redirect()->route('induccion.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        //$docente = Docente::where('cod_prf', Auth::user()->codigo)->first();
        //$docente->name = $docente->paterno.' '.$docente->materno.' '.$docente->nombres;

        $docente = Docente::getName(Auth::user()->codigo);

    	$induccion = Induccion::find($id);
        //$induccion->estugrupo;
        //$induccion->num_mat = $induccion->estugrupo->estumat->num_mat;
        //$induccion->name = $induccion->estugrupo->estumat->estudiante->paterno.' '.$induccion->estugrupo->estumat->estudiante->materno.', '.$induccion->estugrupo->estumat->estudiante->nombres;
        $induccion->estu = Estudiante::getEstudiante($induccion->estugrupo->num_mat);
        $induccion->num_mat = $induccion->estugrupo->num_mat;
        $induccion->name = $induccion->estu->paterno.' '.$induccion->estu->materno.', '.$induccion->estu->nombres;

        $iteminducs = Iteminduc::where('enable', true)->get();  
        $procinducs = Procinduc::where('enable', true)->get();

        $induccion_item = array();
        foreach ($induccion->iteminducs as $iteminduc ) {
            $induccion_item[$iteminduc->pivot->item_id] = $iteminduc->pivot->eva_ind;
        }
        $induccion_proc = array();
        foreach ($induccion->procinducs as $procinduc ) {
            $induccion_proc[$procinduc->pivot->proc_id] = $procinduc->pivot->eva_ind;
        }

        return view('induccion.edit')
            ->with('docente', $docente)
            ->with('induccion', $induccion)
            ->with('iteminducs', $iteminducs)
            ->with('procinducs', $procinducs)
            ->with('induccion_item', $induccion_item)
            ->with('induccion_proc', $induccion_proc);

    }
    public function update(InduccionRequest $request, $id) {
        $induccion_item = array();
        foreach ($request->eva_items as $item_id => $eva_ind) {
            $induccion_item[$item_id] = ['eva_ind' => $eva_ind];
        }
        $induccion_proc = array();
        foreach ($request->eva_procs as $proc_id => $eva_ind) {
            $induccion_proc[$proc_id] = ['eva_ind' => $eva_ind];
        }

    	$induccion = Induccion::find($id);
        $induccion->fill($request->all());
        $induccion->save();

        $induccion->iteminducs()->sync($induccion_item);
        $induccion->procinducs()->sync($induccion_proc);

        Flash::warning('Se ha editado la inducción de forma exitosa');
        return redirect()->route('induccion.index');
    }
    public function destroy($id) {
    	$induccion = Induccion::find($id);

        foreach ($induccion->iteminducs as $iteminduc ) {
            $iteminduc->pivot->delete();
        }
        foreach ($induccion->procinducs as $procinduc ) {
            $procinduc->pivot->delete();
        }

        $induccion->delete();

        Flash::error('Se ha borrado la induccion de forma exitosa');
        return redirect()->route('induccion.index');
    }
}
