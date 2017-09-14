<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;
use DB;

class Carrera extends Model
{
    protected $connection = "unapnet";
    protected $table = "carrera"; 
    protected $primaryKey = 'cod_car';
    protected $fillable = ['cod_car', 'car_des']; 
    public $incrementing = false;
    public $timestamps = false;

    public function estudiantes() { 
    	return $this->hasMany('tutoria\Estudiante', 'cod_car', 'cod_car'); 
    } 
    public function docentes() { 
    	return $this->hasMany('tutoria\Docente', 'cod_car', 'cod_car'); 
    } 
    public static function getCarrera($cod_car) {
        return DB::connection('unapnet')
            ->table('carrera')
            ->select('cod_car', 'car_des')
            ->where('cod_car', $cod_car)
            ->first();
    }
    public static function getCar_des($cod_car) {
        $carrera = Carrera::getcarrera($cod_car);
        if($carrera != null) {
            return $carrera->car_des;
        }
        return "";
        
    }
}
