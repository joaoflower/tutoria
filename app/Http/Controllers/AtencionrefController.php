<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\Sesindi17Request;
use Laracasts\Flash\Flash;

use tutoria\Grupo;
use tutoria\Itemreferido;
use tutoria\Estugrupo;
use tutoria\Estudiante;
use tutoria\Docente;
use tutoria\Carrera;
use tutoria\Sesindi17ref;

use tutoria\Atencionref;

class AtencionrefController extends Controller
{
	private $ano_aca = '2018';
	private $per_aca = '01';

    public function __construct()
    {
        $this->middleware('auth');
    }
    private function getAtendidos() {
        # Estableciendo itemreferidos
        switch ( Auth::user()->id ) {
            case 4591:  $referidoTo = array(10); break;  # Pastoral
            case 4592:  $referidoTo = array(1); break; # Psicopedagogia
            case 7425:  $referidoTo = array(2, 3, 4, 5); break; # Bienestar Universitario
            case 8544:  $referidoTo = array( 11 ); break; # Defensoría del estudiante
            case 8545:  $referidoTo = array( 12 ); break; # Responsabilidad Social
            case 8546:  $referidoTo = array( 13 ); break; # Consultorio Juridico
            default: $referidoTo = array(0); break;
        }
        # Falta implementar tablas para las oficinas y referidos

        # Obteniendo estudiantes referidos
        $id = Auth::user()->id;
        $grupos = Grupo::select('id', 'cod_prf', 'cod_car')
            ->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)                        
            ->has('estugrupos.sesindi17s.sesindi17refs.atencionref')            
            ->with(['estugrupos.sesindi17s.sesindi17refs' => function( $query ) use($referidoTo, $id) {  # use: variables externas
                    $query->whereIn('referido_id', $referidoTo);
                }])
            ->get();  
        if($grupos->count() > 0) {
            $grupos->each( function( $grupo ) { 
                $grupo->docente = Docente::getNamedoc( $grupo->cod_prf );
                $grupo->estugrupos->each( function( $estugrupo ) {
                    $estugrupo->estudiante = Estudiante::getNamestu( $estugrupo->num_mat, $estugrupo->cod_car );
                    $estugrupo->carrera = Carrera::getCar_des( $estugrupo->cod_car );
                    $estugrupo->sesindi17s->each( function( $sesindi17 ) {
                        $sesindi17->sesindi17refs->each( function( $sesindi17ref ) {
                            $sesindi17ref->atencionref;
                        } );
                    } );
                } );
            } );
        }
        //dd($grupos);
        return $grupos;
    }
    public function index(Request $request) {        
        $grupos = $this->getAtendidos();
        # generando atendido
        $atendidos[""] = "";
        $atendidos["si"] = "ATENDIDO";
        $atendidos["no"] = "NO ATENDIDO";
        $atendido = Collection::make($atendidos);

        return view('atencion.index')->with('grupos', $grupos)->with('atendido', $atendido);
	}
    public function getAtencion(Request $request) {
        if($request->ajax()) {
            $atencion = Atencionref::find($request->get('atencion_id'));
            return response()->json( ['atendido' => $atencion->atendido, 'fecha' => $atencion->fecha, 'recomendacion' => $atencion->recomendacion]);
        }
    }
    public function updateAtencion(Request $request) {
        if($request->ajax()) {
            $atencion = Atencionref::find($request->get('atencion_id'));
            $atencion->fill($request->all());
            $atencion->save();
        }
    }
    public function dropAtencion(Request $request) {
        if($request->ajax()) {
            $atencion = Atencionref::find($request->get('atencion_id'));
            $atencion->delete();

            $grupos = $this->getAtendidos();
            return view('atencion.index-atencion')->with('grupos', $grupos);
        }
    }
}
