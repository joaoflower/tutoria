<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;
use DB;

class Usudoc extends Model
{
    protected $connection = "unapnet";
    protected $table = "usudoc"; 
    protected $fillable = ['login', 'cod_prf', 'cod_car', 'passwd']; 

    public function docente() { 
    	return $this->belongsTo('tutoria\Docente', 'cod_prf', 'cod_prf')->where('cod_car', $this->cod_car);
    } 
}
