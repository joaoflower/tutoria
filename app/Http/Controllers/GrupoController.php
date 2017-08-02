<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estugrupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Induccion;
use tutoria\Iteminduc;
use tutoria\Procinduc;
use tutoria\Sesindi;
use tutoria\Evalses;
use tutoria\Itadoc;
use tutoria\Mesita;
use tutoria\Dificultad;
use tutoria\Avanceaca;
use tutoria\Avancepes;
use tutoria\Evaldoc;
use tutoria\Itemevaldoc;
use tutoria\Sesgru;
use tutoria\Carrera;
use tutoria\User;
use Auth;
use Laracasts\Flash\Flash; 
use tutoria\Http\Requests\GrupoRequest; 

class GrupoController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '01';
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
    	$grupos = Grupo::getGrupos($this->ano_aca, $this->per_aca, Auth::user()->cod_car);
		return view('grupo.index')->with('grupos', $grupos); 
	}
    public function create() {
        $docs = Docente::getDocentes(Auth::user()->cod_car);
    	foreach ($docs as $doc) {
		    $doc2[$doc->cod_prf] = $doc->paterno.' '.$doc->materno.' '.$doc->nombres;
		}
		$docentes = Collection::make($doc2);

    	return view('grupo.create')->with('docentes', $docentes); 
    }
    public function createstu($id) {
    	$grupo = Grupo::find($id);
    	$grupo->nameDocente = Docente::getName($grupo->cod_prf);

        $estus = Estumat::getEstumats(Auth::user()->cod_car);
    	foreach ($estus as $estu) {
		    $estu2[$estu->num_mat] = $estu->paterno.' '.$estu->materno.' '.$estu->nombres;
		}
		$estudiantes = Collection::make($estu2);

        $estugrupos = Estugrupo::getEstudiantes($grupo->id);

        /*$estugrupos = Estugrupo::getEstudiantes(1);
        dd($estugrupos);*/
		return view('grupo.createstu')->with('grupo',$grupo)->with('estudiantes', $estudiantes)->with('estugrupos', $estugrupos);
    }
    public function store(GrupoRequest $request) {
    	
        $grupoDoc = Grupo::getByDocente($this->ano_aca, $this->per_aca, Auth::user()->cod_car, $request->cod_prf);

        if(empty($grupoDoc)) {
            $grupo = new Grupo($request->all());
            $grupo->name = $request->cod_prf;
            $grupo->cod_car = Auth::user()->cod_car;
            $grupo->ano_aca = $this->ano_aca;
            $grupo->per_aca = $this->per_aca;
            $grupo->save();

            //$sesgruase->sesgru()->associate($sesgru);
            //return $this->edit($grupo->id);        

            $ano_aca_o = '2016';
            $per_aca_o = '02';

            $grupo_o = Grupo::where('cod_prf', $request->cod_prf)->where('ano_aca', $ano_aca_o)->where('per_aca', $per_aca_o)->first();
            if($grupo_o != null) { 
                if($grupo_o->estugrupos->count() > 0) {
                    $estugrupos_o = $grupo_o->estugrupos;

                    foreach($estugrupos_o as $estugrupo_o) {
                        $estugrupo = new Estugrupo();
                        $estugrupo->grupo_id = $grupo->id;
                        $estugrupo->num_mat = $estugrupo_o->num_mat;
                        $estugrupo->cod_car = $estugrupo_o->cod_car;
                        $estugrupo->save();                    
                    }
                }
            }
        } else {
            $grupo = Grupo::find($grupoDoc->id);
        }

        return redirect()->route('grupo.edit', $grupo->id);
    }
    public function edit($id) {
        $grupo = Grupo::find($id);
        $grupo->nameDocente = Docente::getName($grupo->cod_prf);

        // Con tutor
        $conTutorTemp = Estugrupo::getConTutor(Auth::user()->cod_car, $this->ano_aca, $this->per_aca);
        foreach ($conTutorTemp as $estu) {
            $conTutor[$estu->num_mat] = true;
        }
        $estu2 = array();        
        $regular = array();
        $regular2 = array();

        # Estableciendo "SELECCIONE ESTUDIANTE A "
         $estu2["000000"] = "Seleccione un estudiante INGRESANTE para agregarlo al tutor";
         $regular2["000000"] = "Seleccione un estudiante REGULAR para agregarlo al tutor";
        # -------------------------------------
        $estus = Estumat::getEstumats(Auth::user()->cod_car);
        foreach ($estus as $estu) {
            if(empty($conTutor[$estu->num_mat]))
                $estu2[$estu->num_mat] = $estu->paterno.' '.$estu->materno.' '.$estu->nombres;
            else if(!$conTutor[$estu->num_mat]) 
                $estu2[$estu->num_mat] = $estu->paterno.' '.$estu->materno.' '.$estu->nombres;
        }        
        $regular = Estumat::getRegulares(Auth::user()->cod_car); 
        foreach ($regular as $estu) {
            if(empty($conTutor[$estu->num_mat]))
                $regular2[$estu->num_mat] = $estu->paterno.' '.$estu->materno.' '.$estu->nombres;
            else if(!$conTutor[$estu->num_mat]) 
                $regular2[$estu->num_mat] = $estu->paterno.' '.$estu->materno.' '.$estu->nombres;
        }        
        
        $estudiantes = Collection::make($estu2);
        $regulares = Collection::make($regular2);

        //dd($estu2);

        $estugrupos = Estugrupo::getEstudiantes($grupo->id);

        /*$estugrupos = Estugrupo::getEstudiantes(1);
        dd($estugrupos);*/
        return view('grupo.createstu')
            ->with('grupo',$grupo)
            ->with('estudiantes', $estudiantes)
            ->with('regulares', $regulares)
            ->with('estugrupos', $estugrupos);
    }
    public function update(Request $request, $id) {
        
    }
    public function destroy($id) {
        $grupo = Grupo::find($id);

        foreach ($grupo->estugrupos as $estugrupo ) {
            $estugrupo->delete();
        }

        $grupo->delete();

        Flash::error('Se ha borrado el tutor de forma exitosa');
        return redirect()->route('grupo.index');

    }
    public function addEstugrupo(Request $request, $id, $num_mat) {
        if($request->ajax()) {
            $estugrupo = new Estugrupo();
            $estugrupo->grupo_id = $id;
            $estugrupo->num_mat = $num_mat;
            //$estugrupo->cod_car = Auth::user()->cod_car;
            $estugrupo->cod_car = Estumat::getCod_car($num_mat);
            $estugrupo->save();

            $estugrupos = Estugrupo::getEstudiantes($id);

            return view('grupo.tutorados')->with('estugrupos', $estugrupos);
        }
    }
    public function delEstugrupo(Request $request, $grupo_id, $id) {
        if($request->ajax()) {
            $estugrupo = Estugrupo::find($id);
            if($estugrupo->grupo_id == $grupo_id) {
                $estugrupo->delete();
            }           

            $estugrupos = Estugrupo::getEstudiantes($grupo_id);

            return view('grupo.tutorados')->with('estugrupos', $estugrupos);
        }
    }
    public function storestu(Request $request, $id) {
    	$estudiantes = $request->estudiantes;
    	foreach($estudiantes as $num_mat) {
    		$estugrupo = new Estugrupo();
    		$estugrupo->grupo_id = $id;
    		$estugrupo->num_mat = $num_mat;
    		$estugrupo->cod_car = Auth::user()->cod_car;
    		$estugrupo->save();    		
    	}
    	Flash::success('Se ha guardado los estudiantes  de forma satisfactoria !'); 
    	
    	return redirect()->route('grupo.index');
    }
    public function show($id) {
        // Igual que function index de Estugrupo
        $grupo = Grupo::find($id);
        if($grupo != null) { 
            $grupo->nameDocente = Docente::getName($grupo->cod_prf);
            $grupo->sesgrus;
            $grupo->count_sesg = $grupo->sesgrus->count();

            if($grupo->estugrupos->count() > 0) {
                $estugrupos = $grupo->estugrupos;
                $estugrupos->each(function($estugrupo) { 

                    $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
                    $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;

                    $estugrupo->car_des = $estugrupo->estu->car_des;

                    $estugrupo->induccion;

                    $estugrupo->sesindis;
                    $estugrupo->count_sesi = $estugrupo->sesindis->count();

                    $estugrupo->itadocs;
                    $estugrupo->count_itad = $estugrupo->itadocs->count();

                    $estugrupo->evaldoc; 
                });
                $estugrupos = $estugrupos->sortBy(function($estugrupo) {
                    return $estugrupo->name;
                });
                return view('grupo.show')->with('grupo',$grupo)->with('estugrupos', $estugrupos);
            }

        }
        return view('nohayestu');
    }
    public function showInduccion($id) {
        $induccion = Induccion::find($id);
        $induccion->nameDocente = Docente::getName($induccion->estugrupo->grupo->cod_prf);

        $induccion->estu = Estudiante::getEstudiante($induccion->estugrupo->num_mat);
        $induccion->nameEstudiante = $induccion->estu->paterno.' '.$induccion->estu->materno.', '.$induccion->estu->nombres;

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

        return view('grupo.showInduccion')
            ->with('induccion',$induccion)
            ->with('iteminducs', $iteminducs)
            ->with('procinducs', $procinducs)
            ->with('induccion_item', $induccion_item)
            ->with('induccion_proc', $induccion_proc);

    }
    public function showSesindi($id) { 
        $sesindi = Sesindi::find($id);
        $sesindi->nameDocente = Docente::getName($sesindi->estugrupo->grupo->cod_prf);
        
        $sesindi->estu = Estudiante::getEstudiante($sesindi->estugrupo->num_mat);
        $sesindi->nameEstudiante = $sesindi->estu->paterno.' '.$sesindi->estu->materno.', '.$sesindi->estu->nombres;

        $evalsess = Evalses::lists('name', 'id');

        return view('grupo.showSesindi')
            ->with('sesindi', $sesindi)
            ->with('evalsess', $evalsess);        
    }
    public function showItadoc($id) { 
        $itadoc = Itadoc::find($id);
        $itadoc->nameDocente = Docente::getName($itadoc->estugrupo->grupo->cod_prf);
        
        $itadoc->estu = Estudiante::getEstudiante($itadoc->estugrupo->num_mat);
        $itadoc->nameEstudiante = $itadoc->estu->paterno.' '.$itadoc->estu->materno.', '.$itadoc->estu->nombres;

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

        return view('grupo.showItadoc')
            ->with('itadoc', $itadoc)
            ->with('mesitas', $mesitas)
            ->with('dificultads', $dificultads)
            ->with('avanceacas', $avanceacas)
            ->with('avancepess', $avancepess)
            ->with('itadoc_dific', $itadoc_dific)
            ->with('itadoc_avaca', $itadoc_avaca)
            ->with('itadoc_avpes', $itadoc_avpes);
    }
    public function showEvaldoc($id) {
        $evaldoc = Evaldoc::find($id);
        $evaldoc->nameDocente = Docente::getName($evaldoc->estugrupo->grupo->cod_prf);
        
        $evaldoc->estu = Estudiante::getEstudiante($evaldoc->estugrupo->num_mat);
        $evaldoc->nameEstudiante = $evaldoc->estu->paterno.' '.$evaldoc->estu->materno.', '.$evaldoc->estu->nombres;

        $evaldoc_item = array();
        foreach ($evaldoc->itemevaldocs as $itemevaldoc ) {
            $evaldoc_item[$itemevaldoc->pivot->itemeval_id] = $itemevaldoc->pivot->escala;
        }

        $evaldoc_leyenda = ['1' => 'NUNCA', '2' => 'RARA VEZ', '3' => 'FRECUENTEMENTE', '4' => 'CASI SIEMPRE', '5' => 'SIEMPRE'];

        $itemevaldocs = Itemevaldoc::where('enable', true)->get();

        return view('grupo.showEvaldoc')
            ->with('evaldoc', $evaldoc)
            ->with('itemevaldocs', $itemevaldocs)
            ->with('evaldoc_item', $evaldoc_item)
            ->with('evaldoc_leyenda', $evaldoc_leyenda);
    }
    public function showSesgru($id) { 
        $sesgru = Sesgru::find($id);
        $sesgru->nameDocente = Docente::getName($sesgru->grupo->cod_prf);

        $sesgru->grupo->estugrupos->each(function($estugrupo) {
            $estugrupo->estu = Estudiante::getEstudiante($estugrupo->num_mat);
            $estugrupo->name = $estugrupo->estu->paterno.' '.$estugrupo->estu->materno.', '.$estugrupo->estu->nombres;
        });
        foreach ($sesgru->grupo->estugrupos as $eg) {
         $estu_tmp[$eg->id] = $eg->name;
        }
        $estudiantes = Collection::make($estu_tmp); 

        $asi_ests = array();
        $evalses_ids = array();
        foreach ($sesgru->sesgruases as $sesgruase) {
            $asi_ests[$sesgruase->estugrupo_id] = $sesgruase->asi_est;
            $evalses_ids[$sesgruase->estugrupo_id] = $sesgruase->evalses_id;
        }

        $evalsess = Evalses::lists('name', 'id');

        return view('grupo.showSesgru')
         ->with('sesgru', $sesgru)
         ->with('estudiantes', $estudiantes)
         ->with('asi_ests', $asi_ests)
         ->with('evalses_ids', $evalses_ids)
         ->with('evalsess', $evalsess);
    }
    public function getCar() {
        $carreras = Carrera::lists('car_des', 'cod_car');
        return view('grupo.getCar')
            ->with('carreras', $carreras);
        //dd($carreras);
    }
    public function setCar(Request $request) {
        //Auth::user()->cod_car = $request->input('cod_car');

        $user = User::find(Auth::user()->id);
        $user->cod_car = $request->input('cod_car');
        $user->save();
        Auth::setUser($user);
        
        return redirect()->route('grupo.index');
        /*$grupos = Grupo::getGrupos($this->ano_aca, $this->per_aca, Auth::user()->cod_car);
        return view('grupo.index')->with('grupos', $grupos);*/
    }

    
    
}
