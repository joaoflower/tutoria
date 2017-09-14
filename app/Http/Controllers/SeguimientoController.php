<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\Sesindi17Request;
use Laracasts\Flash\Flash;

use tutoria\Grupo;
use tutoria\Seguimientoref;
use tutoria\Estugrupo;
use tutoria\Estudiante;

class SeguimientoController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';
    private $grupo;
    private $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::select('id')->where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();
    }
    public function index(Request $request) {
        if($this->grupo != null) {
            # Obteniedo a los estudiantes referidos
            /*$estugrupos = $estugrupos = Estugrupo::select('id', 'num_mat', 'cod_car')->where('grupo_id', $this->grupo->id)
                ->has('sesindi17s.itemreferidos')
                ->with('sesindi17s.itemreferidos')->get();
            if($estugrupos->count() > 0) {
                $estugrupos->each( function( $estugrupo ) { 
                    $estugrupo->estudiante = Estudiante::getNamestu($estugrupo->num_mat, $estugrupo->cod_car);
                } );
            }*/
            $estugrupos = $estugrupos = Estugrupo::select('id', 'num_mat', 'cod_car')->where('grupo_id', $this->grupo->id)
                ->has('sesindi17s.sesindi17refs')
                ->with('sesindi17s.sesindi17refs.atencionref.seguimientoref')->get();
            if($estugrupos->count() > 0) {
                $estugrupos->each( function( $estugrupo ) { 
                    $estugrupo->estudiante = Estudiante::getNamestu($estugrupo->num_mat, $estugrupo->cod_car);
                    $estugrupo->sesindi17s->each( function( $sesindi17 ) {
                        $sesindi17->sesindi17refs->each( function( $sesindi17ref ) {
                            $sesindi17ref->itemreferido;
                        } );
                    } ); 
                } );
            }
            //dd($estugrupos);
            return view('seguimiento.index')->with('estugrupos', $estugrupos);
        }
        return view('nohayestu');
	}
    public function storeSeguimiento(Request $request) {
        if($request->ajax()) {
            $segui = new Seguimientoref($request->all());
            $segui->save();

            /*$grupos = $this->getReferidos();*/
            return view('seguimiento.index-btn-ed')->with('seguimiento', $segui);
        }
    }
    public function getSeguimiento(Request $request) {
        if($request->ajax()) {
            $segui = Seguimientoref::find($request->get('seguimiento_id'));
            return response()->json( ['fecha' => $segui->fecha, 'recomendacion' => $segui->recomendacion]);
        }
    }
    public function updateSeguimiento(Request $request) {
        if($request->ajax()) {
            $segui = Seguimientoref::find($request->get('seguimiento_id'));
            $segui->fill($request->all());
            $segui->save();
        }
    }
    public function dropSeguimiento(Request $request) {
        if($request->ajax()) {
            $segui = Seguimientoref::find($request->get('seguimiento_id'));
            $atencionref_id = $segui->atencionref_id;
            $segui->delete();

            return view('seguimiento.index-btn-n')->with('atencionref_id', $atencionref_id);
        }
    }
}
