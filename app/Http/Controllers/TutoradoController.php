<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Tutorado;
use tutoria\Estudiante;
use tutoria\Estumat;
use tutoria\Carrera;
use tutoria\Itemhabito;
use tutoria\Itemhobby;


class TutoradoController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '02';
    private $tutorado;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tutorado = Tutorado::find(Auth::user()->codigo);

    }
    public function index(Request $request) {
        if($this->tutorado != null) {
            # si falta el segundo form
            if($this->tutorado->celular != "FALTA") {
                $this->tutorado->url = urlencode($this->tutorado->url);
                $estumat = Estumat::select('niv_est')->where('num_mat', Auth::user()->codigo)
                    ->where('cod_car', Auth::user()->cod_car)->where('per_aca', $this->per_aca)
                    ->first();
                $carrera = Carrera::select('car_des')->where('cod_car', Auth::user()->cod_car)->first();
                return view('perfile.index')
                    ->with('tutorado', $this->tutorado)
                    ->with('estumat', $estumat)
                    ->with('carrera', $carrera)
                    ->with('itemhabitos', $this->tutorado->itemhabitos)
                    ->with('itemhobbies', $this->tutorado->itemhobbies);
            } else {
                return redirect()->route('perfile.edit', $this->tutorado->num_mat);
            }
        } else {     
            return redirect()->route('perfile.create');            
        }
	}
    public function create() {
        $tutorado = new Tutorado();
        return view('perfile.create')->with('tutorado', $tutorado);
    }
    public function store(Request $request) {   
        # Array de los hábitos y hobbies (+1)
        $tutorado_hab = array(0,0,0,0,0,0,0,0,0,0);
        $tutorado_hob = array(0,0,0,0,0,0,0);
        # Habitos y hobbies
        $itemhabitos = Itemhabito::where('enable', true)->get();
        $itemhobbies = Itemhobby::where('enable', true)->get();

        if($this->tutorado != null) {
            # Buscando y actualizando 
            $tutorado = Tutorado::find(Auth::user()->codigo);
            $tutorado->fill($request->all());        
            $tutorado->save();
            # Obtener la lista de los hábitos marcados (+1)
            foreach ($tutorado->itemhabitos as $itemhabito ) {
                $tutorado_hab[$itemhabito->pivot->habito_id] = $itemhabito->pivot->enable;
            }
            # Obtener la lista de los hobbies marcados (+1)
            foreach ($tutorado->itemhobbies as $itemhobby ) {
                $tutorado_hob[$itemhobby->pivot->hobby_id] = $itemhobby->pivot->enable;
            }
        } else {
            # Obtenido datos de estudiante
            $estudiante = Estudiante::select('num_mat', 'cod_car', 'paterno', 'materno', 'nombres')
                ->where('num_mat', Auth::user()->codigo)->where('cod_car', Auth::user()->cod_car)->first();
            
            # creando el tutorado
            $tutorado = new Tutorado($request->all());  
            $tutorado->num_mat = $estudiante->num_mat;
            $tutorado->cod_car = $estudiante->cod_car;
            $tutorado->paterno = $estudiante->paterno;
            $tutorado->materno = $estudiante->materno;
            $tutorado->nombres = $estudiante->nombres;
            //$tutorado->fill($estudiante->all());
            $tutorado->celular = "FALTA";
            $tutorado->email = "aa@bb.com";
            $tutorado->save();
        }
        
        return view('perfile.create2')
            ->with('tutorado', $tutorado)
            ->with('tutorado_hab', $tutorado_hab)
            ->with('tutorado_hob', $tutorado_hob)
            ->with('itemhabitos', $itemhabitos)
            ->with('itemhobbies', $itemhobbies);
    }
    public function store2(Request $request) {
        # Almacenar los habitos y hobbies
        $tutorado_hab = array();
        foreach ($request->tutorado_hab as $habito_id => $enable) {
            $tutorado_hab[$habito_id] = ['enable' => $enable];
        }
        $tutorado_hob = array();
        foreach ($request->tutorado_hob as $hobby_id => $enable) {
            $tutorado_hob[$hobby_id] = ['enable' => $enable];
        }

        # Actualizando tutorado
        $tutorado = Tutorado::find(Auth::user()->codigo);
        $tutorado->fill($request->all());        
        $tutorado->save();

        # grabando la relación muchos a muchos
        $tutorado->itemhabitos()->sync($tutorado_hab);
        $tutorado->itemhobbies()->sync($tutorado_hob);

        return redirect()->route('perfile.index');
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	if($this->tutorado != null) {
            return view('perfile.create')->with('tutorado', $this->tutorado);
        } else {
            return redirect()->route('perfile.create');
        }        
    }
    public function update(Request $request, $id) {
    	
    }
}
