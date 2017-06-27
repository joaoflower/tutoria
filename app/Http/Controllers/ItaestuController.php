<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\ItaestuRequest;
use tutoria\Mesita;
use tutoria\Itaestu;
use tutoria\Dificultad;
use tutoria\Avanceaca;
use tutoria\Estugrupo;
use tutoria\Avancepes;
use tutoria\Docente;
use tutoria\Estudiante;
use Laracasts\Flash\Flash;

class ItaestuController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '01';
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

            $itaestus = $estugrupo->itaestus;
            $itaestus->each(function($itaestu) {
              	$itaestu->meses = $itaestu->mesita->names1->name.' - '.$itaestu->mesita->names2->name;
            });

        	return view('itaestu.index')
                ->with('itaestus', $itaestus)
                ->with('docente', $docente);
        }
        return view('error')->with('error', 'No tiene Tutor asignado ...!');
	} 
    public function create() {
       	$estugrupo = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();
       	//$docente = $estugrupo->grupo->docente;
       	//$docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;
        $docente = Docente::getName($estugrupo->grupo->cod_prf);

       	//$estudiante = $estugrupo->estumat->estudiante;
       	//$estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;
        $estudiante = Estudiante::getName(Auth::user()->codigo);

       	$mesitas2 = Mesita::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->get();
       	foreach ($mesitas2 as $mesita) {
       		$mestmp[$mesita->id] = $mesita->names1->name.' - '.$mesita->names2->name;
       	}
       	$mesitas = Collection::make($mestmp);

       	$dificultads = Dificultad::where('enable', true)->get();
       	$avanceacas = Avanceaca::where('enable', true)->get();
       	$avancepess = Avancepes::where('enable', true)->get();

         	return view('itaestu.create')
             ->with('docente', $docente)
             ->with('estudiante', $estudiante)
             ->with('mesitas', $mesitas)
             ->with('dificultads', $dificultads)
             ->with('avanceacas', $avanceacas)
             ->with('avancepess', $avancepess);
    }
    public function store(ItaestuRequest $request) {
        $itaestu_dific = array();
        foreach ($request->itaestu_dific as $dificultad_id => $eva_dif) {
            $itaestu_dific[$dificultad_id] = ['eva_dif' => $eva_dif];
        }
        $itaestu_avaca = array();
        foreach ($request->itaestu_avaca as $avanceaca_id => $eva_ava) {
            $itaestu_avaca[$avanceaca_id] = ['eva_ava' => $eva_ava];
        }
        $itaestu_avpes = array();
        foreach ($request->itaestu_avpes as $avancepes_id => $eva_ava) {
            $itaestu_avpes[$avancepes_id] = ['eva_ava' => $eva_ava];
        }

        $estugrupo = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();

        $itaestu = new Itaestu($request->all());
        $itaestu->estugrupo_id = $estugrupo->id;
        $itaestu->save();
        
        $itaestu->dificultades()->sync($itaestu_dific);
        $itaestu->avanceacas()->sync($itaestu_avaca);
        $itaestu->avancepess()->sync($itaestu_avpes);

        Flash::success('Se ha guardado el Informe Técnico Académico de forma satisfactoria !');

        return redirect()->route('itaestu.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        $itaestu = Itaestu::find($id);

        /*$docente = $itaestu->estugrupo->grupo->docente;
        $docente->name = $docente->paterno.' '.$docente->materno.', '.$docente->nombres;

        $estudiante = $itaestu->estugrupo->estumat->estudiante;
        $estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;*/
        $docente = Docente::getName($itaestu->estugrupo->grupo->cod_prf);
        $estudiante = Estudiante::getName(Auth::user()->codigo);

        $itaestu_dific = array();
        foreach ($itaestu->dificultades as $dificultad ) {
            $itaestu_dific[$dificultad->pivot->dificultad_id] = $dificultad->pivot->eva_dif;
        }
        $itaestu_avaca = array();
        foreach ($itaestu->avanceacas as $avanceaca ) {
            $itaestu_avaca[$avanceaca->pivot->avanceaca_id] = $avanceaca->pivot->eva_ava;
        }
        $itaestu_avpes = array();
        foreach ($itaestu->avancepess as $avancepes ) {
            $itaestu_avpes[$avancepes->pivot->avancepes_id] = $avancepes->pivot->eva_ava;
        }

        $mesitas2 = Mesita::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->get();
        foreach ($mesitas2 as $mesita) {
            $mestmp[$mesita->id] = $mesita->names1->name.' - '.$mesita->names2->name;
        }
        $mesitas = Collection::make($mestmp);

        $dificultads = Dificultad::where('enable', true)->get();
        $avanceacas = Avanceaca::where('enable', true)->get();
        $avancepess = Avancepes::where('enable', true)->get();

        return view('itaestu.edit')
            ->with('itaestu', $itaestu)
            ->with('docente', $docente)
            ->with('estudiante', $estudiante)
            ->with('mesitas', $mesitas)
            ->with('dificultads', $dificultads)
            ->with('avanceacas', $avanceacas)
            ->with('avancepess', $avancepess)
            ->with('itaestu_dific', $itaestu_dific)
            ->with('itaestu_avaca', $itaestu_avaca)
            ->with('itaestu_avpes', $itaestu_avpes);

    }
    public function update(ItaestuRequest $request, $id) {
        $itaestu_dific = array();
        foreach ($request->itaestu_dific as $dificultad_id => $eva_dif) {
            $itaestu_dific[$dificultad_id] = ['eva_dif' => $eva_dif];
        }
        $itaestu_avaca = array();
        foreach ($request->itaestu_avaca as $avanceaca_id => $eva_ava) {
            $itaestu_avaca[$avanceaca_id] = ['eva_ava' => $eva_ava];
        }
        $itaestu_avpes = array();
        foreach ($request->itaestu_avpes as $avancepes_id => $eva_ava) {
            $itaestu_avpes[$avancepes_id] = ['eva_ava' => $eva_ava];
        }

        $itaestu = Itaestu::find($id);
        $itaestu->fill($request->all());
        $itaestu->save();

        $itaestu->dificultades()->sync($itaestu_dific);
        $itaestu->avanceacas()->sync($itaestu_avaca);
        $itaestu->avancepess()->sync($itaestu_avpes);

        Flash::warning('Se ha editado el informe de forma exitosa');
        return redirect()->route('itaestu.index');
    }
    public function destroy($id) {
    	$itaestu = Itaestu::find($id);

        foreach ($itaestu->dificultades as $dificultad ) {
            $dificultad->pivot->delete();
        }
        foreach ($itaestu->avanceacas as $avanceaca ) {
            $avanceaca->pivot->delete();
        }
        foreach ($itaestu->avancepess as $avancepes ) {
            $avancepes->pivot->delete();
        }

        $itaestu->delete();

        Flash::error('Se ha borrado el informe de forma exitosa');
        return redirect()->route('itaestu.index');
    }
}
