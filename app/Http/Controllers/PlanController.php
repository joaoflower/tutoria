<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Plan;
use tutoria\Planfactor;
use tutoria\Itemfactor;
use tutoria\Planobjetivo;
use tutoria\Planactividad;
use Laracasts\Flash\Flash;


class PlanController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';
    private $plan;

    public function __construct()
    {
        $this->middleware('auth');
        $this->plan = Plan::select('id')
            ->where('cod_car', Auth::user()->cod_car)->where('ano_aca', $this->ano_aca)
            ->where('per_aca', $this->per_aca)
            ->first();
    }
    public function index(Request $request) {
        if($this->plan != null) {
            $plan = Plan::find($this->plan->id);
            $planfactores = Planfactor::where('plan_id', $this->plan->id)->with(['itemfactor', 'itemindicadores'])->get();
            $planobjetivos = Planobjetivo::where('plan_id', $this->plan->id)->with('actividades')->get();
            return view('plan.index')->with('plan', $plan)->with('planfactores', $planfactores)->with('planobjetivos', $planobjetivos);
        } else {     
            return redirect()->route('plan.create');            
        }        
	}
    public function getPfiplan($itemindicadores) {
        $pfi = array();
        foreach ($itemindicadores as $item) {
            $pfi[$item->pivot->indicador_id]['data'] = $item->pivot->data;
            $pfi[$item->pivot->indicador_id]['meta'] = $item->pivot->meta;
            $pfi[$item->pivot->indicador_id]['problema'] = $item->pivot->problema;
            $pfi[$item->pivot->indicador_id]['causa'] = $item->pivot->causa;
            $pfi[$item->pivot->indicador_id]['alternativa'] = $item->pivot->alternativa;
            $pfi[$item->pivot->indicador_id]['objetivo'] = $item->pivot->objetivo;
        }
        return $pfi;
    }
    public function getPfiitem($itemindicadores) {
        $pfi = array();
        foreach($itemindicadores as $itemindicador) {
            $pfi[$itemindicador->id]['data'] = null;
            $pfi[$itemindicador->id]['meta'] = null;
            $pfi[$itemindicador->id]['problema'] = null;
            $pfi[$itemindicador->id]['causa'] = null;
            $pfi[$itemindicador->id]['alternativa'] = null;
            $pfi[$itemindicador->id]['objetivo'] = null;
        }
        return $pfi;
    }
    public function createPlan() {
        if($this->plan == null) {            
            # creando un nuevo modelo
            $plan = new Plan();  
            $plan->cod_car = Auth::user()->cod_car;
            $plan->ano_aca = $this->ano_aca;
            $plan->per_aca = $this->per_aca;
            $plan->save();
            $this->plan = Plan::select('id')
                ->where('cod_car', Auth::user()->cod_car)->where('ano_aca', $this->ano_aca)
                ->where('per_aca', $this->per_aca)
                ->first();
        }
    }
    public function create() {
        $this->createPlan();

        $fortaleza = null;        
        $itemfactor = Itemfactor::find(1);
        $itemfactor->itemindicadores;
        
        $planfactor = Planfactor::where('plan_id', $this->plan->id)->where('factor_id', 1)->first();
        if($planfactor != null) {
            $fortaleza = $planfactor->fortaleza;           
            $pfi = $this->getPfiplan($planfactor->itemindicadores);
        } else {
            $pfi = $this->getPfiitem($itemfactor->itemindicadores);
        }

        return view('plan.create')->with('itemfactor', $itemfactor)->with('route', 'plan.store')
            ->with('fortaleza', $fortaleza)->with('pfi', $pfi);
    }
    public function storing(Request $request, $factor_id) {     
        $plan = Plan::find($this->plan->id);
        # get Planfactor
        $planfactor = Planfactor::where('plan_id', $plan->id)->where('factor_id', $factor_id)->first();
        if($planfactor != null) {
            # Actualizando el modelo
            $planfactor->fill($request->all());        
            $planfactor->save();
        } else {
            # creando un nuevo modelo
            $planfactor = new Planfactor($request->all());  
            $planfactor->factor_id = $factor_id;
            $planfactor->plan()->associate($plan);
            $planfactor->save();
        }

        # get planfactor_indicador 
        $planfactor_indicador = array();
        foreach ($request->problema as $id => $valor) {
            $planfactor_indicador[$id] = ['data' => $request->data[$id], 'meta' => $request->meta[$id], 'problema' => $request->problema[$id], 'causa' => $request->causa[$id], 'alternativa' => $request->alternativa[$id], 'objetivo' => $request->objetivo[$id]];
        }
        # grabando la relación muchos a muchos
        $planfactor->itemindicadores()->sync($planfactor_indicador);
    }
    public function store(Request $request) {     
        $this->storing($request, 1);

        $fortaleza = null;        
        $itemfactor = Itemfactor::find(2);
        $itemfactor->itemindicadores;
        
        $planfactor = Planfactor::where('plan_id', $this->plan->id)->where('factor_id', 2)->first();
        if($planfactor != null) {
            $fortaleza = $planfactor->fortaleza;           
            $pfi = $this->getPfiplan($planfactor->itemindicadores);
        } else {
            $pfi = $this->getPfiitem($itemfactor->itemindicadores);
        }

        //Flash::success('Se ha guardado de forma satisfactoria !');
        return view('plan.create')->with('itemfactor', $itemfactor)->with('route', 'plan.store2')
            ->with('fortaleza', $fortaleza)->with('pfi', $pfi);
    }
    public function store2(Request $request) {     
        $this->storing($request, 2);

        $fortaleza = null;        
        $itemfactor = Itemfactor::find(3);
        $itemfactor->itemindicadores;
        
        $planfactor = Planfactor::where('plan_id', $this->plan->id)->where('factor_id', 3)->first();
        if($planfactor != null) {
            $fortaleza = $planfactor->fortaleza;           
            $pfi = $this->getPfiplan($planfactor->itemindicadores);
        } else {
            $pfi = $this->getPfiitem($itemfactor->itemindicadores);
        }

        //Flash::success('Se ha guardado de forma satisfactoria !');
        return view('plan.create')->with('itemfactor', $itemfactor)->with('route', 'plan.store3')
            ->with('fortaleza', $fortaleza)->with('pfi', $pfi);
    }
    public function store3(Request $request) {     
        $this->storing($request, 3);

        $fortaleza = null;        
        $itemfactor = Itemfactor::find(4);
        $itemfactor->itemindicadores;
        
        $planfactor = Planfactor::where('plan_id', $this->plan->id)->where('factor_id', 4)->first();
        if($planfactor != null) {
            $fortaleza = $planfactor->fortaleza;           
            $pfi = $this->getPfiplan($planfactor->itemindicadores);
        } else {
            $pfi = $this->getPfiitem($itemfactor->itemindicadores);
        }

        //Flash::success('Se ha guardado de forma satisfactoria !');
        return view('plan.create')->with('itemfactor', $itemfactor)->with('route', 'plan.store4')
            ->with('fortaleza', $fortaleza)->with('pfi', $pfi);
    }
    public function store4(Request $request) {     
        $this->storing($request, 4);

        //Flash::success('Se ha guardado de forma satisfactoria !');
        $planobjetivos = Planobjetivo::where('plan_id', $this->plan->id)->with('actividades')->get();
        return view('plan.cronograma')->with('planobjetivos', $planobjetivos);
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	return redirect()->route('plan.create');
    }
    public function update(Request $request, $id) {
        
    }
    public function updateEvaluacion(Request $request) {
        if($request->ajax()) {
            $plan = Plan::find( $this->plan->id );
            $plan->evaluacion = $request->get('evaluacion');
            $plan->asistentes = $request->get('asistentes');
            $plan->save();
        }
    }

    public function createCronograma() {
        $planobjetivos = Planobjetivo::where('plan_id', $this->plan->id)->with('actividades')->get();
    	return view('plan.cronograma')->with('planobjetivos', $planobjetivos);
    }
    public function addObjetivo(Request $request) {
        if($request->ajax()) {
            $planobjetivo = new Planobjetivo();
            $planobjetivo->plan_id = $this->plan->id;
            $planobjetivo->objetivo = $objetivo;
            $planobjetivo->save();

            $planobjetivos = Planobjetivo::where('plan_id', $this->plan->id)->with('actividades')->get();
            return view('plan.cronograma-det')->with('planobjetivos', $planobjetivos);
        }
    }
    public function storeObjetivo(Request $request) {
        if($request->ajax()) {
            $planobjetivo = new Planobjetivo();
            $planobjetivo->plan_id = $this->plan->id;
            $planobjetivo->objetivo = $request->get('objetivo');
            $planobjetivo->save();

            return view('plan.cronograma-objetivo')->with('planobjetivo', $planobjetivo);
        }
    }
    public function updateObjetivo(Request $request) {
        if($request->ajax()) {
            $planobjetivo = Planobjetivo::find( $request->get('objetivo_id') );
            $planobjetivo->objetivo = $request->get('objetivo');
            $planobjetivo->save();
        }
    }
    public function storeActividad(Request $request) {
        if($request->ajax()) {
            $planactividad = new Planactividad($request->all());
            $planactividad->save();

            return view('plan.cronograma-actividad')->with('planactividad', $planactividad);
        }
    }
    public function getActividad(Request $request) {
        if($request->ajax()) {
            $pa = Planactividad::find( $request->get('actividad_id') );
            return response()->json( ['actividad' => $pa->actividad, 'uni_med' => $pa->uni_med, 'meta' => $pa->meta,
                'mes1' => $pa->mes1, 'mes2' => $pa->mes2, 'mes3' => $pa->mes3, 'mes4' => $pa->mes4, 'mes5' => $pa->mes5, 
                'responsable' => $pa->responsable ]);
        }
    }
    public function updateActividad(Request $request) {
        if($request->ajax()) {
            $planactividad = Planactividad::find( $request->get('actividad_id') );
            $planactividad->fill($request->all());
            $planactividad->save();
            
            return view('plan.cronograma-actividad-det')->with('planactividad', $planactividad);
        }
    }
}
