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
	private $ano_aca = '2018';
	private $per_aca = '01';

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
            case 8544:  $referidoTo = array( 11 ); break; # Defensoría del estudiante
            case 8545:  $referidoTo = array( 12 ); break; # Responsabilidad Social
            case 8546:  $referidoTo = array( 13 ); break; # Consultorio Juridico
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
        
        
        $itemreferidos = Itemreferido::where('enable', true)->get();
        # FALTA FILTRAR las oficinas ya referidas por estudiante

        return view('referido.index')->with('grupos', $grupos)->with('atendido', $atendido)->with('itemreferidos', $itemreferidos);
	}
    # Aqui storeAtencion, los demas métodos en la clase AtenciónrefController
    public function storeAtencion(Request $request) {
        if($request->ajax()) {
            $atencion = new Atencionref($request->all());
            $atencion->usutut_id = Auth::user()->id;
            $atencion->save();

            # Buscando en la tabla Sesindi17ref
            $sesindi17ref = Sesindi17ref::find( $request->get('sesindiref_id') );
            $sesindi_id = $sesindi17ref->sesindi17->id;

            # Referencias
            if( isset( $request->sesindi17_ref ) ) {
                foreach ( $request->get('sesindi17_ref') as $key => $value ) {
                    $referido = new Sesindi17ref();
                    $referido->sesindi_id = $sesindi_id;
                    $referido->referido_id = $value;
                    $referido->enable = 1;
                    $referido->save();
                }
            }

            $grupos = $this->getReferidos();
            return view('referido.index-referido')->with('grupos', $grupos);
            //return dd( $sesindi17_ref );
        }
    }
}
