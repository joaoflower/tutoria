<?php

namespace tutoria\Http\Controllers;

use Illuminate\Http\Request;

use tutoria\Http\Requests;

class TutoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('index');
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
