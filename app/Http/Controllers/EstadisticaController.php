<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use DB;

use tutoria\Grupo;
use tutoria\Estugrupo;
use tutoria\Plan;
use tutoria\Planfactor;


class EstadisticaController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request) {
        # Obtenindo la cantidad de grupo por escuela
        $grupos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->leftJoin('unapnet.carrera', 'grupo.cod_car', '=', 'carrera.cod_car')
            ->groupBy('grupo.cod_car')
            ->get( ['grupo.cod_car', 'carrera.car_des', DB::raw('count(*) as canti_gru')] );

        # Obteniendo la Cantidad de tutorados por escuela
        $estugrupos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->leftJoin('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_estu'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_estu', 'cod_car');   # pluck(value, key)

        # Obteniendo la Cantidad de sesiones grupales por escuela
        $sesgru17s = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->join('sesgru17', 'grupo.id', '=', 'sesgru17.grupo_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_sesgru17'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_sesgru17', 'cod_car');   # pluck(value, key)        

        # Obteniendo la Cantidad de sesiones individuales por escuela
        $sesindi17s = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->join('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->join('sesindi17', 'estugrupo.id', '=', 'sesindi17.estugrupo_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_sesindi17'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_sesindi17', 'cod_car');   # pluck(value, key)     

        # Obteniendo la Cantidad de referencias por escuela
        $referidos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->join('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->join('sesindi17', 'estugrupo.id', '=', 'sesindi17.estugrupo_id')
            ->join('sesindi17_ref', 'sesindi17.id', '=', 'sesindi17_ref.sesindi_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_referido'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_referido', 'cod_car');   # pluck(value, key)        

        # Obteniendo la Cantidad de atenciones por escuela
        $atenciones = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->join('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->join('sesindi17', 'estugrupo.id', '=', 'sesindi17.estugrupo_id')
            ->join('sesindi17_ref', 'sesindi17.id', '=', 'sesindi17_ref.sesindi_id')
            ->join('atencionref', 'sesindi17_ref.id', '=', 'atencionref.sesindiref_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_atencion'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_atencion', 'cod_car');   # pluck(value, key)   

        # Obteniendo la Cantidad de seguimientos por escuela
        $seguimientos = Grupo::where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->join('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->join('sesindi17', 'estugrupo.id', '=', 'sesindi17.estugrupo_id')
            ->join('sesindi17_ref', 'sesindi17.id', '=', 'sesindi17_ref.sesindi_id')
            ->join('atencionref', 'sesindi17_ref.id', '=', 'atencionref.sesindiref_id')
            ->join('seguimientoref', 'atencionref.id', '=', 'seguimientoref.atencionref_id')
            ->select('grupo.cod_car', DB::raw('count(*) as canti_seguimiento'))
            ->groupBy('grupo.cod_car')
            ->pluck('canti_seguimiento', 'cod_car');   # pluck(value, key)   

        $grupos->each( function( $grupo ) use ( $estugrupos, $sesgru17s, $sesindi17s, $referidos, $atenciones, $seguimientos ) {
            $grupo->canti_estu = $estugrupos[ $grupo->cod_car ];
            if( isset( $sesgru17s[ $grupo->cod_car ] ) ) {
                $grupo->canti_sesgru17 = $sesgru17s[ $grupo->cod_car ];
            } else {
                $grupo->canti_sesgru17 = 0;
            }
            if( isset( $sesindi17s[ $grupo->cod_car ] ) ) {
                $grupo->canti_sesindi17 = $sesindi17s[ $grupo->cod_car ];
            } else {
                $grupo->canti_sesindi17 = 0;
            }
            if( isset( $referidos[ $grupo->cod_car ] ) ) {
                $grupo->canti_referido = $referidos[ $grupo->cod_car ];
            } else {
                $grupo->canti_referido = 0;
            }
            if( isset( $atenciones[ $grupo->cod_car ] ) ) {
                $grupo->canti_atencion = $atenciones[ $grupo->cod_car ];
            } else {
                $grupo->canti_atencion = 0;
            }
            if( isset( $seguimientos[ $grupo->cod_car ] ) ) {
                $grupo->canti_seguimiento = $seguimientos[ $grupo->cod_car ];
            } else {
                $grupo->canti_seguimiento = 0;
            }
        } );

        # Para mostrar el gráfico
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
        # Obteniendo información estadistica de los grupos
        $grupos = Grupo::where( 'ano_aca', $this->ano_aca )->where( 'per_aca', $this->per_aca )->where( 'grupo.cod_car', $cod_car )
            ->leftJoin('unapnet.carrera', 'grupo.cod_car', '=', 'carrera.cod_car')
            ->leftJoin('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            //->leftJoin('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->select('grupo.id', 'carrera.car_des', 'grupo.cod_prf', 'docente.paterno', 'docente.materno', 'docente.nombres') //, DB::raw('count(*) as canti_estu'))
            //->groupBy('grupo.id')
            ->orderBy('docente.paterno', 'asc')
            //->with('sesgru17s', 'estugrupos.sesindi17s.sesindi17refs.atencionref.seguimientoref')
            ->get();
        
        # Obteniendo informacion estadistica de los grupos (estugrupos: sesindi17s.sesindi17refs.atencionref.seguimientoref)
        $gestas = Grupo::where( 'ano_aca', $this->ano_aca )->where( 'per_aca', $this->per_aca )->where( 'grupo.cod_car', $cod_car )
            ->select( 'grupo.id' )
            ->with('sesgru17s', 'estugrupos.sesindi17s.sesindi17refs.atencionref.seguimientoref')
            ->get();

        $esta = array();
        if( $gestas->count() > 0 ) {
            # Recorriendo grupos -> grupo
            $gestas->each( function( $grupo ) use( &$esta ) {
                $grupo->canti_estu = 0;
                $grupo->canti_sesgru17 = 0;
                $grupo->canti_sesindi17 = 0;
                $grupo->canti_referido = 0;
                $grupo->canti_atencion = 0;
                $grupo->canti_seguimiento = 0;

                if( $grupo->sesgru17s->count() > 0 ) {
                    $grupo->canti_sesgru17 = $grupo->sesgru17s->count();
                }
                if( $grupo->estugrupos->count() > 0 ) {
                    $grupo->canti_estu = $grupo->estugrupos->count();
                    # Recorriendo estugrupos -> tutorados
                    $grupo->estugrupos->each( function( $estugrupo ) use( $grupo ) {
                        $this->getEstaEstugrupo( $estugrupo );
                        $grupo->canti_sesindi17 += $estugrupo->canti_sesindi17;
                        $grupo->canti_referido += $estugrupo->canti_referido;
                        $grupo->canti_atencion += $estugrupo->canti_atencion;
                        $grupo->canti_seguimiento += $estugrupo->canti_seguimiento;
                    } );
                }
                $esta[ $grupo->id ] = [ 'estu' => $grupo->canti_estu, 'sesgru17' => $grupo->canti_sesgru17, 
                    'sesindi17' => $grupo->canti_sesindi17, 'referido' => $grupo->canti_referido,
                    'atencion' => $grupo->canti_atencion, 'seguimiento' => $grupo->canti_seguimiento];
            } );
        }
        # copiando las estadisticas
        if( $grupos->count() > 0 ) {
            $grupos->each( function( $grupo ) use( $esta ) {
                $grupo->canti_estu = $esta[ $grupo->id ]['estu'];
                $grupo->canti_sesgru17 = $esta[ $grupo->id ]['sesgru17'];
                $grupo->canti_sesindi17 = $esta[ $grupo->id ]['sesindi17'];
                $grupo->canti_referido = $esta[ $grupo->id ]['referido'];
                $grupo->canti_atencion = $esta[ $grupo->id ]['atencion'];
                $grupo->canti_seguimiento = $esta[ $grupo->id ]['seguimiento'];
            } );
        }
        
        return view('estadistica.show-grupos')->with('grupos', $grupos);
    }
    private function getEstaEstugrupo( &$estugrupo ) {
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
    }
    public function showPlan( $cod_car ) {
        $plan = Plan::where('cod_car', $cod_car)->where('ano_aca', $this->ano_aca)
            ->where('per_aca', $this->per_aca)
            ->first();
        if($plan != null) {
            $planfactores = Planfactor::where('plan_id', $plan->id)->with(['itemfactor', 'itemindicadores', 'actividades'])->get();
            return view('plan.index')->with('plan', $plan)->with('planfactores', $planfactores); 
        } else {
            return view('error')->with('error', 'No hay plan de Tutoría');
        }
    }
    public function showTutorados( $grupo_id ) {
        # Obteniendo docentes tutores
        $docente = Grupo::where( 'id', $grupo_id )
            ->leftJoin('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            ->select('grupo.cod_prf', 'docente.paterno', 'docente.materno', 'docente.nombres')
            ->first();
        # Obteniendo informacion estadistica de un grupo (estugrupos: sesindi17s.sesindi17refs.atencionref.seguimientoref)
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
                $this->getEstaEstugrupo( $estugrupo );
                /*$estugrupo->canti_sesindi17 = 0;
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
                }     */       
            } );
        }
        //dd($estugrupos);
        return view('estadistica.show-tutorados')->with('estugrupos', $estugrupos)->with('docente', $docente);
    }

}
