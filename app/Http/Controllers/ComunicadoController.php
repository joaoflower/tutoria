<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use Illuminate\Support\Collection;
use tutoria\User;
use tutoria\Comunicado;
use tutoria\Carrera;


class ComunicadoController extends Controller
{
    private $ano_aca = '2018';
	private $per_aca = '01';

    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function index(Request $request) {
        # Comunicados
        $comunicados = $this->getComunicados();
        # Obteniendo Carrera
        $carreras = Carrera::pluck('car_des', 'cod_car');
        $carreras->put("","");
        $carreras->put("00","TODAS LAS ESCUELAS PROFESIONALES");
        $items = $carreras->all();
        ksort($items);
        $carreras = collect($items);

        # generando para
        $paras[""] = "";
        $paras["head"] = "COORDINADORES DE TUTORÍA";
        $paras["teacher"] = "DOCENTES TUTORES";
        $paras["student"] = "TUTORADOS";
        $paras["oficina"] = "OFICINAS DE APOYO";
        $paras["all"] = "TODOS";        
        $para = Collection::make($paras);

        return view('comunicado.index')->with('comunicados', $comunicados)->with('carreras', $carreras)->with('para', $para);
	}
    private function getCar_des($cod_car) {
        if($cod_car == "00") {
            return "Todas las escuelas profesionales";
        } else {
            return Carrera::getCar_des($cod_car);
        }
    }
    private function getPara_des($para) {
        switch ($para) {
            case 'head':    $para_des = "COORDINADORES DE TUTORÍA"; break;
            case 'teacher': $para_des = "DOCENTES TUTORES"; break;
            case 'student': $para_des = "TUTORADOS"; break;
            case 'oficina':   $para_des = "OFICINAS DE APOYO"; break;
            case 'all': $para_des = "TODOS"; break;
            default:    $para_des = "Nínguno"; break;
        }
        return $para_des;
    }
    private function getComunicados() {        
        $comunicados = Comunicado::select('id', 'cod_car', 'para', 'asunto')
            ->where('usutut_id', Auth::user()->id)
            ->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->where('enable', 1)->get();
        if($comunicados->count() > 0) {
            $comunicados->each( function( $comunicado ) { 
                $comunicado->car_des = $this->getCar_des($comunicado->cod_car);
                $comunicado->para_des = $this->getPara_des($comunicado->para);                
            } );
        }
        return $comunicados;
    }
    public function create() {
    }
    public function store(Request $request) {  
    }
    public function show($id) {        
    }
    public function edit($id) {
    }
    public function update(Request $request, $id) {
    }
    public function destroy($id) {
    }
    public function storeComunicado(Request $request) {
        if($request->ajax()) {
            $comunica = new Comunicado($request->all());
            $comunica->usutut_id = Auth::user()->id;
            $comunica->ano_aca = $this->ano_aca;
            $comunica->per_aca = $this->per_aca;
            $comunica->enable = 1;
            $comunica->save();

            $comunicados = $this->getComunicados();
            return view('comunicado.index-comunicado')->with('comunicados', $comunicados);
        }
    }
    public function getComunicado(Request $request) {  
        if($request->ajax()) {
            $comunica = Comunicado::find($request->get('comunicado_id'));
            return response()->json( ['cod_car' => $comunica->cod_car, 'para' => $comunica->para, 'asunto' => $comunica->asunto, 'mensaje' => $comunica->mensaje]);
        }
    }
    public function updateComunicado(Request $request) {  
        if($request->ajax()) {
            $comunica = Comunicado::find($request->get('comunicado_id'));
            $comunica->fill($request->all());            
            $comunica->save();
            $comunica->car_des = $this->getCar_des($comunica->cod_car);
            $comunica->para_des = $this->getPara_des($comunica->para);
            return view('comunicado.index-comunicado-det')->with('comunicado', $comunica);
        }
    }
    public function dropComunicado(Request $request) {  
        if($request->ajax()) {
            $comunica = Comunicado::find($request->get('comunicado_id'));
            $comunica->enable = 0;
            $comunica->save();

            $comunicados = $this->getComunicados();
            return view('comunicado.index-comunicado')->with('comunicados', $comunicados);
        }
    }
}
