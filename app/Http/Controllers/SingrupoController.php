<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Illuminate\Support\Collection;
use Auth;
use tutoria\Http\Requests\Sesindi17Request;
use tutoria\Docente;
use tutoria\Grupo;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Evalses;
use tutoria\Sesindi;
use tutoria\Sesindi17;
use tutoria\Estugrupo;
use tutoria\Itemproblema;
use tutoria\Areaproblema;
use tutoria\Itemreferido;
use Laracasts\Flash\Flash;


class SingrupoController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '01';
    private $grupo;
    private $name;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();        
        $this->name = Auth::user()->name;
    }
    public function index(Request $request) {
        $conTutorTemp = Estugrupo::getConTutorAll($this->ano_aca, $this->per_aca);
        foreach ($conTutorTemp as $estu) {
            $conTutor[$estu->num_mat] = true;
        }

        $estumats = Estumat::select('num_mat', 'cod_car')
            ->where('per_aca', $this->per_aca)
            ->whereIn('niv_est', ['01','02','03','04'])
            /*->with(['estudiante' => function ($query) {
                $query->select('paterno', 'materno', 'nombres')
                    ->where('num_mat', 'estumat2017all.num_mat');
            }])*/
            ->get();
        
        $estu2 = array(); 
        foreach ($estumats as $estu) {
            if(empty($conTutor[$estu->num_mat]))
                $estu2[$estu->num_mat] = Estudiante::getName($estu->num_mat);
            else if(!$conTutor[$estu->num_mat]) 
                $estu2[$estu->num_mat] = Estudiante::getName($estu->num_mat);
        }   

        $estudiantes = Collection::make($estu2);
        dd($estudiantes);


        /*
        # Verificar si tiene grupo 
        if($this->grupo != null) { 
            if($this->grupo->estugrupos->count() > 0) {     # Si tiene tutorados
                # Obtener 
                $sesindi17 = null;
                $count = 0;
                foreach ($this->grupo->estugrupos as $eg) {
                    $sesindi17[$count] = Sesindi17::where('estugrupo_id',$eg->id);
                    $count++;
                }

                $sesindi17s = null;
                if($count > 0) {
                    $query = $sesindi17[0];
                    for($ii = 1; $ii < $count; $ii++) {
                        $query = $query->union($sesindi17[$ii]);
                    }
                    $sesindi17s = $query->get();
                }
                $sesindi17s->each(function($sesindi) {
                    $sesindi->estugrupo;
                    $sesindi->estu = Estudiante::getEstudiante($sesindi->estugrupo->num_mat);
                    $sesindi->num_mat = $sesindi->estugrupo->num_mat;
                    $sesindi->name = $sesindi->estu->paterno.' '.$sesindi->estu->materno.', '.$sesindi->estu->nombres;
                });

                $sesindi17s = $sesindi17s->sortBy(function($sesindi) {
                    return $sesindi->name.$sesindi->nro_ses.$sesindi->fecha;
                });

            	return view('sesuna.index')->with('sesindi17s', $sesindi17s);
            }
            $sesindi17s = null;
            return view('sesuna.index')->with('sesindi17s', $sesindi17s);
        }
        return view('nohayestu');*/
	}
    public function create() {
        # Obtener la lista de los estudiantes sin sesión individual
        $estugrupos = Estugrupo::getSinSes($this->ano_aca,  $this->per_aca);
        
        
        /*$estumats = Estumat::select('num_mat', 'cod_car')
            ->where('per_aca', $this->per_aca)
            ->whereIn('niv_est', ['01','02','03','04'])
            ->with(['estudiante' => function ($query) {
                $query->select('paterno', 'materno', 'nombres');
            }])
            ->get();
        dd($estumats);*/

        # Genera un Collection($estudiantes) con la lista de los estudiantes
		foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = Estudiante::getName($eg->num_mat);
        }
        $estudiantes = Collection::make($estu_tmp);     

        # Obtener el area e item de los problemas, y el ser referido
        $areaproblemas = Areaproblema::where('enable', true)->with('itemproblemas')->get();
        $itemreferidos = Itemreferido::where('enable', true)->get();

        return view('sesuna.create')
            ->with('docente', $this->name)
            ->with('estudiantes', $estudiantes)
            ->with('areaproblemas', $areaproblemas)
            ->with('itemreferidos', $itemreferidos);
    }
    public function store(Sesindi17Request $request) {
        # Almacenar los problemas y referidos en arrays
        /*$sesindi17_pro = array();
        foreach ($request->sesindi17_pro as $problema_id => $enable) {
            $sesindi17_pro[$problema_id] = ['enable' => $enable];
        }
        $sesindi17_ref = array();
        foreach ($request->sesindi17_ref as $referido_id => $enable) {
            $sesindi17_ref[$referido_id] = ['enable' => $enable];
        }*/
        
        # Creando un nuevo y grabando la sesion individual
        $sesindi17 = new Sesindi17($request->all());        
        $count = Sesindi17::where('estugrupo_id', $sesindi17->estugrupo_id)->count();        
        $sesindi17->nro_ses = $count + 1;
        $sesindi17->save();
        //dd($sesindi17);

        # Cambiando el estugrupo        
        /*$estugrupo = Estugrupo::find($sesindi17->estugrupo_id);
        $estugrupo->grupo_id = $this->grupo->id;
        $Estugrupo->save();*/
        $estugrupo = Estugrupo::find($sesindi17->estugrupo_id);
        $grupo = Grupo::find($this->grupo->id);
        $estugrupo->grupo()->associate($grupo);
        $estugrupo->save();

        //dd($estugrupo);

        

        # grabando la relación muchos a muchos
        /*$sesindi17->itemproblemas()->sync($sesindi17_pro);
        $sesindi17->itemreferidos()->sync($sesindi17_ref);*/

        Flash::success('Se ha guardado la sesión de forma satisfactoria !');
    	return redirect()->route('sesuna.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	$sesindi17 = Sesindi17::find($id);
        $sesindi17->name = Estudiante::getName($sesindi17->estugrupo->num_mat);

        # Obtener la lista de los problemas marcados
        $sesindi17_pro = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 );
        foreach ($sesindi17->itemproblemas as $itemproblema ) {
            $sesindi17_pro[$itemproblema->pivot->problema_id] = $itemproblema->pivot->enable;
        }
        # Obtener la lista de los referidos
        $sesindi17_ref = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 );
        foreach ($sesindi17->itemreferidos as $itemreferido ) {
            $sesindi17_ref[$itemreferido->pivot->referido_id] = $itemreferido->pivot->enable;
        }

        # Obtener el area e item de los problemas, y el ser referido
        $areaproblemas = Areaproblema::where('enable', true)->with('itemproblemas')->get();
        $itemreferidos = Itemreferido::where('enable', true)->get();

        return view('sesuna.edit')
            ->with('docente', $this->name)
            ->with('sesindi17', $sesindi17)
            ->with('sesindi17_pro', $sesindi17_pro)
            ->with('sesindi17_ref', $sesindi17_ref)
            ->with('areaproblemas', $areaproblemas)
            ->with('itemreferidos', $itemreferidos);
    }
    public function update(Request $request, $id) {
        # Almacenar los problemas y referidos en arrays
        /*$sesindi17_pro = array();
        foreach ($request->sesindi17_pro as $problema_id => $enable) {
            $sesindi17_pro[$problema_id] = ['enable' => $enable];
        }
        $sesindi17_ref = array();
        foreach ($request->sesindi17_ref as $referido_id => $enable) {
            $sesindi17_ref[$referido_id] = ['enable' => $enable];
        }*/

    	$sesindi17 = Sesindi17::find($id);
        $sesindi17->fill($request->all());
        $sesindi17->save();

        # grabando la relación muchos a muchos
        /*$sesindi17->itemproblemas()->sync($sesindi17_pro);
        $sesindi17->itemreferidos()->sync($sesindi17_ref);*/

        Flash::warning('Se ha editado la sesión de forma exitosa');
        return redirect()->route('sesuna.index');
    }
    public function destroy($id) {
    	$sesindi17 = Sesindi17::find($id);

        foreach ($sesindi17->itemproblemas as $itemproblema ) {
            $itemproblema->pivot->delete();
        }
        foreach ($sesindi17->itemreferidos as $itemreferido ) {
            $itemreferido->pivot->delete();
        }

        $sesindi17->delete();

        Flash::error('Se ha borrado la sesión de forma exitosa');
        return redirect()->route('sesuna.index');
    }
}
