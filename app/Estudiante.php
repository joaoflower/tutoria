<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

use DB;

class Estudiante extends Model
{
	protected $connection = "unapnet";
    protected $table = "estudiante"; 
    protected $fillable = ['num_mat', 'cod_car', 'paterno', 'materno', 'nombres']; 

    public function estumats() { 
    	return $this->hasMany('tutoria\Estumat', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car); 
    } 
    public function carrera() { 
    	return $this->belongsTo('tutoria\Carrera', 'cod_car', 'cod_car'); 
    } 
    public static function getEstudiante($num_mat) {
        return DB::connection('unapnet')
            ->table('estudiante')
            ->leftjoin('unapnet.carrera', 'estudiante.cod_car', '=', 'carrera.cod_car')
            ->select('num_mat', 'paterno', 'materno', 'nombres', 'car_des')
            ->where('num_mat', $num_mat)
            ->first();
    }
    public static function getName($num_mat) {
        $estu = Estudiante::getEstudiante($num_mat);
        return $estu->paterno.' '.$estu->materno.', '.$estu->nombres;
    }
}
