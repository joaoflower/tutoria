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
use tutoria\Evalaspecto;
use tutoria\Areaspecto;
use tutoria\Itemreferido;
use tutoria\Estugrupo;
use tutoria\Encusati;
use Laracasts\Flash\Flash;


class EncusatiController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '01';    
    private $name;
    private $sesindi17;
    private $cod_prf;

    public function __construct()
    {
        $this->middleware('auth');        
        $this->name = Estudiante::getName(Auth::user()->codigo);
        $this->sesindi17 = null;
        $this->cod_prf  = null;        

        # Obteniendo la sesion Individual y cod_prf
        $estugrupos = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)
            ->with(['grupo' => function($query) {
                $query->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca);
            }, 'sesindi17s'])->get();        

        foreach ($estugrupos as $eg) {
            if($eg->grupo != null) {
                $this->cod_prf = $eg->grupo->cod_prf;
                foreach ($eg->sesindi17s as $si17) {
                    $this->sesindi17 = $si17;
                }
            }
        }
        #---------------------------------
    }
    public function index(Request $request) {
        # Obteniendo la sesion Individual
        /*$estugrupos = Estugrupo::where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)
            ->with(['grupo' => function($query) {
                $query->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca);
            }, 'sesindi17s'])->get();

        $cod_prf  = "";
        $estugrupo = null;
        $sesindi17 = null;
        foreach ($estugrupos as $eg) {
            if($eg->grupo != null) {
                //$estugrupo = $eg;
                $cod_prf = $eg->grupo->cod_prf;
                foreach ($eg->sesindi17s as $si17) {
                    $sesindi17 = $si17;
                }
            }
        }*/
        #---------------------------------

        # Si tutor realizó sesión
        if($this->sesindi17 != null) {
            $hasEncusati = false;
            # Si no hay encuesta
            foreach($this->sesindi17->encusatis as $encusati) {
                $hasEncusati = true;
            }
            if(!$hasEncusati) {
                $docente = Docente::getName($this->cod_prf);
                
                # Obtener el area e item 
                $areaspectos = Areaspecto::where('enable', true)->with('itemaspectos')->get();
                $evalaspectos = Evalaspecto::lists('name', 'id');
                return view('encusati.create')
                    ->with('docente', $docente)
                    ->with('estudiante', $this->name)
                    ->with('areaspectos', $areaspectos)
                    ->with('evalaspectos', $evalaspectos);  
            } else {
                return view('encusati.index')
                    ->with('encusatis', $this->sesindi17->encusatis);
            }
        }
        # Si tutor no realizó sesión
        return view('error')->with('error', 'El Tutor no realizó ninguna sesión de Tutoría');
	}
    public function create() {

    }
    public function store(Request $request) {
        $encusati = new Encusati($request->all());
        $encusati->sesindi17_id = $this->sesindi17->id;
        $encusati->save();

        $encusati_aspecto = array();
        foreach ($request->encusati_aspecto as $aspecto_id => $evalaspecto_id) {
            $encusati_aspecto[$aspecto_id] = ['evalaspecto_id' => $evalaspecto_id];
        }
        $encusati->itemaspectos()->sync($encusati_aspecto);

        if($this->cod_prf == '999999' or $this->cod_prf == '999998') {
            //$docente = Docente::getDocente($this->cod_prf);
            $estudiante = Estudiante::getEstudiante(Auth::user()->codigo);
            $docente = Docente::getName($this->cod_prf);
            return view('encusati.constanciauna')
                ->with('docente', $docente)
                ->with('estudiante', $estudiante)
                ->with('encusati', $encusati);
        } else {
            $docente = Docente::getDocente($this->cod_prf);
            return view('encusati.constancia')
                ->with('docente', $docente)
                ->with('estudiante', $this->name)
                ->with('encusati', $encusati);
        }
    }
    public function show($id) {
         $encusati = Encusati::find($id);

        if($this->cod_prf == '999999' or $this->cod_prf == '999998') {
            //$docente = Docente::getDocente($this->cod_prf);
            $estudiante = Estudiante::getEstudiante(Auth::user()->codigo);
            $docente = Docente::getName($this->cod_prf);
            return view('encusati.constanciauna')
                ->with('docente', $docente)
                ->with('estudiante', $estudiante)
                ->with('encusati', $encusati);
        } else {
            $docente = Docente::getDocente($this->cod_prf);
            return view('encusati.constancia')
                ->with('docente', $docente)
                ->with('estudiante', $this->name)
                ->with('encusati', $encusati);
        }
    }
    public function edit($id) {
    	
    }
    public function update(Request $request, $id) {
        
    }
    public function destroy($id) {
    	
    }
}
