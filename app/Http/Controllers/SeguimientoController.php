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


class SeguimientoController extends Controller
{
	private $ano_aca = '2017';
	private $per_aca = '02';
    private $grupo;
    private $name;

    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index(Request $request) {
        return view('seguimiento.index');
	}
    public function viewInfo(Request $request, $num_mat) {
        
    }
    public function create() {

    }
    public function store(Request $request, $id) {     
        
    }
    public function show($id) {
        
    }
    public function edit($id) {
    	
    }
    public function update(Request $request, $id) {
        
    }
    public function destroy($id) {
    	
    }
}
