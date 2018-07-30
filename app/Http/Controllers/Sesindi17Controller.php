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
use tutoria\Itemproblema;
use tutoria\Areaproblema;
use tutoria\Itemreferido;
use tutoria\Tutor;
use Laracasts\Flash\Flash;


class Sesindi17Controller extends Controller
{
	private $ano_aca = '2018';
	private $per_aca = '01';
    private $grupo;
    private $name;
    private $tutor;

    public function __construct()
    {
        $this->middleware('auth');
        $this->grupo = Grupo::where('cod_prf', Auth::user()->codigo)->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)->first();        
        $this->name = Docente::getName(Auth::user()->codigo);
        $this->tutor = Tutor::find(Auth::user()->codigo);
    }
    public function getSesindi17s() {
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
        return $sesindi17s;
    }
    public function index(Request $request) {
        if($this->tutor != null) {
            # Verificar si tiene grupo 
            if($this->grupo != null) { 
                if($this->grupo->estugrupos->count() > 0) {     # Si tiene tutorados
                    # Obtener 
                    $sesindi17s = $this->getSesindi17s();

                    return view('sesindi17.index')->with('sesindi17s', $sesindi17s);
                }
            }
            return view('nohayestu');
        } else {
            return redirect()->route('perfild.create');
        }
    }
    public function create() {
        # Obtener la lista de los estudiantes del grupo y agrega atributo name(PaMaNo)
        $estugrupos = $this->grupo->estugrupos;
    	$estugrupos->each(function($estugrupo) {
            $estugrupo->name = Estudiante::getName($estugrupo->num_mat);
    	});

        # Genera un Collection($estudiantes) con la lista de los estudiantes
        $estu_tmp[""] = "";
    	foreach ($estugrupos as $eg) {
            $estu_tmp[$eg->id] = $eg->name;
		}
		$estudiantes = Collection::make($estu_tmp);   	

        # Obtener el area e item de los problemas, y el ser referido
        $areaproblemas = Areaproblema::where('enable', true)->with('itemproblemas')->get();
        $itemreferidos = Itemreferido::where('enable', true)->get();

    	return view('sesindi17.create')
            ->with('docente', $this->name)
            ->with('estudiantes', $estudiantes)
            ->with('areaproblemas', $areaproblemas)
            ->with('itemreferidos', $itemreferidos);
    }
    public function store(Sesindi17Request $request) {
        # Almacenar los problemas y referidos en arrays
        $sesindi17_pro = array();
        if( isset($request->sesindi17_pro) ) {
            foreach ($request->sesindi17_pro as $problema_id => $enable) {
                $sesindi17_pro[$problema_id] = ['enable' => $enable];
            }
        }
        $sesindi17_ref = array();
        if( isset($request->sesindi17_ref) ) {
            foreach ($request->sesindi17_ref as $referido_id => $enable) {
                $sesindi17_ref[$referido_id] = ['enable' => $enable];
            }
        }       
        
        # Creando un nuevo y grabando la sesion individual
        $sesindi17 = new Sesindi17($request->all());        
        $count = Sesindi17::where('estugrupo_id', $sesindi17->estugrupo_id)->count();        
        $sesindi17->nro_ses = $count + 1;
        $sesindi17->save();

        # grabando la relación muchos a muchos
        $sesindi17->itemproblemas()->sync($sesindi17_pro);
        $sesindi17->itemreferidos()->sync($sesindi17_ref);

        Flash::success('Se ha guardado la sesión de forma satisfactoria !');
    	return redirect()->route('sesindi17.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	$sesindi17 = Sesindi17::find($id);
        $sesindi17->name = Estudiante::getName($sesindi17->estugrupo->num_mat);

        # Obtener la lista de los problemas marcados (+ 1)
        $sesindi17_pro = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 );
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

        //dd($sesindi17_pro);

        return view('sesindi17.edit')
            ->with('docente', $this->name)
            ->with('sesindi17', $sesindi17)
            ->with('sesindi17_pro', $sesindi17_pro)
            ->with('sesindi17_ref', $sesindi17_ref)
            ->with('areaproblemas', $areaproblemas)
            ->with('itemreferidos', $itemreferidos);
    }
    public function update(Request $request, $id) {
        # Almacenar los problemas y referidos en arrays
        $sesindi17_pro = array();
        if( isset($request->sesindi17_pro) ) {
            foreach ($request->sesindi17_pro as $problema_id => $enable) {
                $sesindi17_pro[$problema_id] = ['enable' => $enable];
            }
        }
        $sesindi17_ref = array();
        if( isset($request->sesindi17_ref) ) {
            foreach ($request->sesindi17_ref as $referido_id => $enable) {
                $sesindi17_ref[$referido_id] = ['enable' => $enable];
            }
        }

    	$sesindi17 = Sesindi17::find($id);
        $sesindi17->fill($request->all());
        $sesindi17->save();

        # grabando la relación muchos a muchos
        $sesindi17->itemproblemas()->sync($sesindi17_pro);
        $sesindi17->itemreferidos()->sync($sesindi17_ref);

        Flash::warning('Se ha editado la sesión de forma exitosa');
        return redirect()->route('sesindi17.index');
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
        return redirect()->route('sesindi17.index');
    }
    public function dropSesindi17(Request $request, $id) {
        if($request->ajax()) {
            $sesindi17 = Sesindi17::find($id);

            foreach ($sesindi17->itemproblemas as $itemproblema ) {
                $itemproblema->pivot->delete();
            }
            foreach ($sesindi17->itemreferidos as $itemreferido ) {
                $itemreferido->pivot->delete();
            }

            $sesindi17->delete();

            $sesindi17s = $this->getSesindi17s();

            return view('sesindi17.index-sesindi17s')->with('sesindi17s', $sesindi17s);
        }
    }
}
