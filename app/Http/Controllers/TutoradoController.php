<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

use Auth;


class TutoradoController extends Controller
{
    private $ano_aca = '2017';
	private $per_aca = '02';
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        return view('perfile.index');
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
}
