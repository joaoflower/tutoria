<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\EvalestuRequest;
use tutoria\Mesita;
use tutoria\Estugrupo;
use tutoria\Itemevalestu;
use tutoria\Evalestu;
use tutoria\Docente;
use tutoria\Estudiante;
use Laracasts\Flash\Flash;

class EvalestuController extends Controller
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
            //$docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;
            $docente = Docente::getName($estugrupo->grupo->cod_prf);

            $escala = 0;

            $evalestu = $estugrupo->evalestu;        

            if($evalestu != null) {
            	foreach ($evalestu->itemevalestus as $itemevalestu) {
    	        	$escala += $itemevalestu->pivot->escala;
    	        }
    	        //$docente->escala = $escala;
            }
            
        	return view('evalestu.index')
                ->with('evalestu', $evalestu)
                ->with('docente', $docente)
                ->with('escala', $escala);
        }
        return view('error')->with('error', 'No tiene Tutor asignado ...!');
	} 
    public function create() {
       	$estugrupo = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();
       	/*$docente = $estugrupo->grupo->docente;
       	$docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;

       	$estudiante = $estugrupo->estumat->estudiante;
       	$estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;*/
        $docente = Docente::getName($estugrupo->grupo->cod_prf);
        $estudiante = Estudiante::getName(Auth::user()->codigo);
       	
       	$itemevalestus = Itemevalestu::where('enable', true)->get();

     	return view('evalestu.create')
        	->with('docente', $docente)
         	->with('estudiante', $estudiante)
         	->with('itemevalestus', $itemevalestus);
    }
    public function store(EvalestuRequest $request) {
        $evalestu_item = array();
        foreach ($request->evalestu_item as $itemeval_id => $escala) {
            $evalestu_item[$itemeval_id] = ['escala' => $escala];
        }

        $estugrupo = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();

        $evalestu = new Evalestu($request->all());
        $evalestu->estugrupo_id = $estugrupo->id;
        $evalestu->save();

        $evalestu->itemevalestus()->sync($evalestu_item);

        Flash::success('Se ha guardado la evaluación de forma satisfactoria !');

        return redirect()->route('evalestu.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	$evalestu = Evalestu::find($id);

    	/*$docente = $evalestu->estugrupo->grupo->docente;
        $docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;

        $estudiante = $evalestu->estugrupo->estumat->estudiante;
        $estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;*/
        $docente = Docente::getName($evalestu->estugrupo->grupo->cod_prf);
        $estudiante = Estudiante::getName(Auth::user()->codigo);

        $evalestu_item = array();
        foreach ($evalestu->itemevalestus as $itemevalestu ) {
            $evalestu_item[$itemevalestu->pivot->itemeval_id] = $itemevalestu->pivot->escala;
        }

        $itemevalestus = Itemevalestu::where('enable', true)->get();

     	return view('evalestu.edit')
     		->with('evalestu', $evalestu)
        	->with('docente', $docente)
         	->with('estudiante', $estudiante)
         	->with('itemevalestus', $itemevalestus)
         	->with('evalestu_item', $evalestu_item);
    }
    public function update(EvalestuRequest $request, $id) {
    	$evalestu_item = array();
        foreach ($request->evalestu_item as $itemeval_id => $escala) {
            $evalestu_item[$itemeval_id] = ['escala' => $escala];
        }

        $evalestu = Evalestu::find($id);
        $evalestu->fill($request->all());
        $evalestu->save();

        $evalestu->itemevalestus()->sync($evalestu_item);

        Flash::warning('Se ha editado la evaluación de forma exitosa');
        return redirect()->route('evalestu.index');
    }
    public function destroy($id) {
    	$evalestu = Evalestu::find($id);

        foreach ($evalestu->itemevalestus as $itemevalestu ) {
            $itemevalestu->pivot->delete();
        }

        $evalestu->delete();

        Flash::error('Se ha borrado la evaluación de forma exitosa');
        return redirect()->route('evalestu.index');
    }
}
