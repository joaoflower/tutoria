<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;
use tutoria\Comunicado;

class TutoriaController extends Controller
{
    private $ano_aca = '2018';
    private $per_aca = '01';

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $comunicados = Comunicado::select('asunto', 'mensaje')
            ->whereIn('cod_car', ['00', Auth::user()->cod_car])            
            ->where('ano_aca', $this->ano_aca)->where('per_aca', $this->per_aca)
            ->whereIn('para', ['all', Auth::user()->type])
            ->where('enable', 1)->get();
        return view('index')->with('comunicados', $comunicados);
    }
    public function nohayEstu()
    {
        return view('nohayestu');
    }
    public function nohayDoc()
    {
        return view('nohaydoc');
    }
}
