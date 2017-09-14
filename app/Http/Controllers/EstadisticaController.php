<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use DB;

use tutoria\Grupo;
use tutoria\Estugrupo;


class EstadisticaController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request) {
        $grupos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->leftJoin('unapnet.carrera', 'grupo.cod_car', '=', 'carrera.cod_car')
            ->groupBy('grupo.cod_car')
            ->get( ['grupo.cod_car', 'carrera.car_des', DB::raw('count(*) as canti_gru')] );

        $estugrupos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->leftJoin('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_estu'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_estu', 'cod_car');   # pluck(value, key)

        $grupos->each( function( $grupo ) use ( $estugrupos ) {
            $grupo->canti_estu = $estugrupos[ $grupo->cod_car ];
        } );

        $carrera = array();
        $dataTutor = array();
        $dataTutorado = array();
        $dsTutor = array();
        $dsTutorado = array();
        $data = array();

        foreach($grupos as $grupo) {
            $carrera[] = $grupo->cod_car;
            $dataTutor[] =  $grupo->canti_gru;
            $dataTutorado[] =  $grupo->canti_estu;
        }
        
        $data['labels'] = $carrera;
        
        $dsTutor['label'] = "Tutores";
        $dsTutor['backgroundColor'] = "rgba(235, 193, 66, 0.4)";
        $dsTutor['borderColor'] = "rgba(235, 193, 66, 1)";
        $dsTutor['pointBorderColor'] = "rgba(235, 193, 66, 1)";
        $dsTutor['data'] = $dataTutor ;

        $dsTutorado['label'] = "Tutorados";
        $dsTutorado['backgroundColor'] = "rgba(3, 169, 244, 0.4)";
        $dsTutorado['borderColor'] = "rgba(3, 169, 244, 1)";
        $dsTutorado['pointBorderColor'] = "rgba(3, 169, 244, 1)";
        $dsTutorado['data'] =  $dataTutorado ;

        $data['datasets'] = array($dsTutor, $dsTutorado);
        $dataJson = json_encode($data);

        //dd($dataJson);
        return view('estadistica.index')->with('grupos', $grupos)->with('data', $dataJson);
	}
    public function showGrupos( $cod_car ) {
        $grupos = Grupo::where( 'ano_aca', $this->ano_aca )->where( 'per_aca', $this->per_aca )->where( 'grupo.cod_car', $cod_car )
            ->leftJoin('unapnet.carrera', 'grupo.cod_car', '=', 'carrera.cod_car')
            ->leftJoin('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            ->leftJoin('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->select('grupo.id', 'carrera.car_des', 'grupo.cod_prf', 'docente.paterno', 'docente.materno', 'docente.nombres', DB::raw('count(*) as canti_estu'))
            ->groupBy('grupo.id')
            ->orderBy('docente.paterno', 'asc')
            ->get();
        return view('estadistica.show-grupos')->with('grupos', $grupos);
    }
    public function showTutorados( $grupo_id ) {
        $docente = Grupo::where( 'id', $grupo_id )
            ->leftJoin('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            ->select('grupo.cod_prf', 'docente.paterno', 'docente.materno', 'docente.nombres')
            ->first();
        $estugrupos = Estugrupo::where( 'grupo_id', $grupo_id )
            ->leftJoin('unapnet.carrera', 'estugrupo.cod_car', '=', 'carrera.cod_car')
            ->leftJoin('unapnet.estudiante', 'estugrupo.num_mat', '=', 'estudiante.num_mat')
            //->leftJoin('sesindi17', 'estugrupo.id', '=', 'sesindi17.estugrupo_id')
            ->select('estugrupo.id', 'carrera.car_des', 'estugrupo.num_mat', 'estudiante.paterno', 'estudiante.materno', 'estudiante.nombres')
            //->groupBy('estugrupo.id')
            ->orderBy('estudiante.paterno', 'asc')
            ->with('sesindi17s.sesindi17refs.atencionref.seguimientoref')
            ->get();

        if( $estugrupos->count() > 0 ) {
            # Recorriendo estugrupos -> tutorados
            $estugrupos->each( function( $estugrupo ) {
                $estugrupo->canti_sesindi17 = 0;
                $estugrupo->canti_referido = 0;
                $estugrupo->canti_atencion = 0;
                $estugrupo->canti_seguimiento = 0;

                if( $estugrupo->sesindi17s->count() > 0 ) {
                    $estugrupo->canti_sesindi17 = $estugrupo->sesindi17s->count();
                    # Recorriendo sesindi17s - sesiones
                    $estugrupo->sesindi17s->each( function( $sesindi17 ) use( $estugrupo ) {
                        if( $sesindi17->sesindi17refs->count() > 0 ) {
                            $estugrupo->canti_referido += $sesindi17->sesindi17refs->count();
                            # Recorriendo sesindi17refs - referidos
                            $sesindi17->sesindi17refs->each( function( $sesindi17ref ) use( $estugrupo ) {
                                # Si hay atencion
                                if( $sesindi17ref->atencionref != null ) {
                                    $estugrupo->canti_atencion++;
                                    # Si hay seguimiento
                                    if( $sesindi17ref->atencionref->seguimientoref != null ) {
                                        $estugrupo->canti_seguimiento++;
                                    }
                                }
                            } );    
                        }                  
                    } );
                }            
            } );
        }
        //dd($estugrupos);
        return view('estadistica.show-tutorados')->with('estugrupos', $estugrupos)->with('docente', $docente);
    }

}
