<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\ItadocRequest;
use tutoria\Mesita;
use tutoria\Itaestu;
use tutoria\Itadoc;
use tutoria\Dificultad;
use tutoria\Avanceaca;
use tutoria\Estugrupo;
use tutoria\Grupo;
use tutoria\Docente;
use tutoria\Estudiante;
use tutoria\Avancepes;
use Laracasts\Flash\Flash;

class ItadocController extends Controller
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
            		$estugrupo->itadocs->each(function($itadoc) {
            			$itadoc->meses = $itadoc->mesita->names1->name.' - '.$itadoc->mesita->names2->name;
            		});
            		//$estugrupo->name = $estugrupo->estumat->estudiante->paterno.' '.$estugrupo->estumat->estudiante->materno.', '.$estugrupo->estumat->estudiante->nombres;
                    $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
                    $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;
            	});

            	return view('itadoc.index')
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
            $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;
    	});
    	foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
		}
		$estudiantes = Collection::make($estu_tmp);

		$mesitas2 = Mesita::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->get();
       	foreach ($mesitas2 as $mesita) {
       		$mestmp[$mesita->id] = $mesita->names1->name.' - '.$mesita->names2->name;
       	}
       	$mesitas = Collection::make($mestmp);

       	$dificultads = Dificultad::where('enable', true)->get();
       	$avanceacas = Avanceaca::where('enable', true)->get();
       	$avancepess = Avancepes::where('enable', true)->get();

     	return view('itadoc.create')
         	->with('docente', $docente)
         	->with('estudiantes', $estudiantes)
         	->with('mesitas', $mesitas)
         	->with('dificultads', $dificultads)
         	->with('avanceacas', $avanceacas)
         	->with('avancepess', $avancepess);
    }
    public function store(ItadocRequest $request) {
        $itadoc_dific = array();
        foreach ($request->itadoc_dific as $dificultad_id => $eva_dif) {
            $itadoc_dific[$dificultad_id] = ['eva_dif' => $eva_dif];
        }
        $itadoc_avaca = array();
        foreach ($request->itadoc_avaca as $avanceaca_id => $eva_ava) {
            $itadoc_avaca[$avanceaca_id] = ['eva_ava' => $eva_ava];
        }
        $itadoc_avpes = array();
        foreach ($request->itadoc_avpes as $avancepes_id => $eva_ava) {
            $itadoc_avpes[$avancepes_id] = ['eva_ava' => $eva_ava];
        }

        $itadoc = new Itadoc($request->all());
        $itadoc->save();
        
        $itadoc->dificultades()->sync($itadoc_dific);
        $itadoc->avanceacas()->sync($itadoc_avaca);
        $itadoc->avancepess()->sync($itadoc_avpes);

        Flash::success('Se ha guardado el Informe Técnico Académico de forma satisfactoria !');

        return redirect()->route('itadoc.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
        $itadoc = Itadoc::find($id);
        $docente = $this->name;        

        //$estudiante = $itadoc->estugrupo->estumat->estudiante;
        //$estudiante->name = $estudiante->paterno.' '.$estudiante->materno.', '.$estudiante->nombres;
        $estudiante = Estudiante::getName($itadoc->estugrupo->num_mat);

        $itadoc_dific = array();
        foreach ($itadoc->dificultades as $dificultad ) {
            $itadoc_dific[$dificultad->pivot->dificultad_id] = $dificultad->pivot->eva_dif;
        }
        $itadoc_avaca = array();
        foreach ($itadoc->avanceacas as $avanceaca ) {
            $itadoc_avaca[$avanceaca->pivot->avanceaca_id] = $avanceaca->pivot->eva_ava;
        }
        $itadoc_avpes = array();
        foreach ($itadoc->avancepess as $avancepes ) {
            $itadoc_avpes[$avancepes->pivot->avancepes_id] = $avancepes->pivot->eva_ava;
        }

        $mesitas2 = Mesita::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->get();
        foreach ($mesitas2 as $mesita) {
            $mestmp[$mesita->id] = $mesita->names1->name.' - '.$mesita->names2->name;
        }
        $mesitas = Collection::make($mestmp);

        $dificultads = Dificultad::where('enable', true)->get();
        $avanceacas = Avanceaca::where('enable', true)->get();
        $avancepess = Avancepes::where('enable', true)->get();

        return view('itadoc.edit')
            ->with('itadoc', $itadoc)
            ->with('docente', $docente)
            ->with('estudiante', $estudiante)
            ->with('mesitas', $mesitas)
            ->with('dificultads', $dificultads)
            ->with('avanceacas', $avanceacas)
            ->with('avancepess', $avancepess)
            ->with('itadoc_dific', $itadoc_dific)
            ->with('itadoc_avaca', $itadoc_avaca)
            ->with('itadoc_avpes', $itadoc_avpes);
    }
    public function update(ItadocRequest $request, $id) {
        $itadoc_dific = array();
        foreach ($request->itadoc_dific as $dificultad_id => $eva_dif) {
            $itadoc_dific[$dificultad_id] = ['eva_dif' => $eva_dif];
        }
        $itadoc_avaca = array();
        foreach ($request->itadoc_avaca as $avanceaca_id => $eva_ava) {
            $itadoc_avaca[$avanceaca_id] = ['eva_ava' => $eva_ava];
        }
        $itadoc_avpes = array();
        foreach ($request->itadoc_avpes as $avancepes_id => $eva_ava) {
            $itadoc_avpes[$avancepes_id] = ['eva_ava' => $eva_ava];
        }

        $itadoc = Itadoc::find($id);
        $itadoc->fill($request->all());
        $itadoc->save();

        $itadoc->dificultades()->sync($itadoc_dific);
        $itadoc->avanceacas()->sync($itadoc_avaca);
        $itadoc->avancepess()->sync($itadoc_avpes);

        Flash::warning('Se ha editado el informe de forma exitosa');
        return redirect()->route('itadoc.index');
    }
    public function destroy($id) {
    	$itadoc = Itadoc::find($id);

        foreach ($itadoc->dificultades as $dificultad ) {
            $dificultad->pivot->delete();
        }
        foreach ($itadoc->avanceacas as $avanceaca ) {
            $avanceaca->pivot->delete();
        }
        foreach ($itadoc->avancepess as $avancepes ) {
            $avancepes->pivot->delete();
        }

        $itadoc->delete();

        Flash::error('Se ha borrado el informe de forma exitosa');
        return redirect()->route('itadoc.index');
    }
}
