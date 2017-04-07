<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;
use DB;

class Usuest extends Model
{
    protected $connection = "unapnet";
    protected $table = "usuest"; 
    protected $fillable = ['login', 'num_mat', 'cod_car', 'passwd'];


    public function estudiante() { 
    	return $this->belongsTo('tutoria\Estudiante', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car);
    }

}
