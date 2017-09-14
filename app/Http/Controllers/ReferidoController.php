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

class ReferidoController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';

    public function __construct()
    {
        $this->middleware('auth');
    }
    private function getReferidos() {
        # Estableciendo itemreferidos
        switch ( Auth::user()->id ) {
            case 4591:  $referidoTo = array(10); break;  # Pastoral
            case 4592:  $referidoTo = array(1); break; # Psicopedagogia
            case 7425:  $referidoTo = array(2, 3, 4, 5); break; # Bienestar Universitario
            default: $referidoTo = array(0); break;
        }
        # Obteniendo estudiantes referidos
        $grupos = Grupo::select('id', 'cod_prf', 'cod_car')
            ->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)                        
            ->has('estugrupos.sesindi17s.itemreferidos')            
            ->with(['estugrupos.sesindi17s.sesindi17refs' => function( $query ) use($referidoTo) {  # use: para usar variables externas
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
                            $sesindi17ref->itemreferido;
                            $sesindi17ref->atencionref;
                        } );
                    } );
                } );
            } );
        }
        return $grupos;
    }
    public function index(Request $request) {        
        $grupos = $this->getReferidos();
        # generando atendido
        $atendidos[""] = "";
        $atendidos["si"] = "ATENDIDO";
        $atendidos["no"] = "NO ATENDIDO";
        $atendido = Collection::make($atendidos);

        return view('referido.index')->with('grupos', $grupos)->with('atendido', $atendido);
	}
    public function storeAtencion(Request $request) {
        if($request->ajax()) {
            $atencion = new Atencionref($request->all());
            $atencion->usutut_id = Auth::user()->id;
            $atencion->save();

            $grupos = $this->getReferidos();
            return view('referido.index-referido')->with('grupos', $grupos);
        }
    }
}
