<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

use DB;

class Estumat extends Model
{
	protected $connection = "unapnet";
    protected $table = "estumat2016all"; 
    protected $fillable = ['num_mat', 'cod_car', 'ano_aca', 'per_aca', 'niv_est']; 

    public function estugrupos() { 
    	return $this->hasMany('tutoria\Estugrupo', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car); 
    }
    public function estudiante() { 
    	return $this->belongsTo('tutoria\Estudiante', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car);
    } 
    public static function getEstumats($cod_car) {
    	return DB::connection('unapnet')
    		->table('estumat2016all')
            ->leftjoin('unapnet.estudiante', 'estumat2016all.num_mat', '=', 'estudiante.num_mat')
            ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
            ->where('estumat2016all.cod_car', $cod_car)
            ->whereIn('estumat2016all.niv_est', ['01', '02'])
            ->orderBy('paterno', 'asc')
            ->get();
    }
    public static function getEstumat($num_mat) {
        return DB::connection('unapnet')
            ->table('estumat2016all')
            ->leftjoin('unapnet.estudiante', 'estumat2016all.num_mat', '=', 'estudiante.num_mat')
            ->leftjoin('unapnet.carrera', 'estumat2016all.cod_car', '=', 'carrera.cod_car')
            ->select('estudiante.num_mat', 'paterno', 'materno', 'nombres', 'car_des')
            ->where('estumat2016all.num_mat', $num_mat)
            ->first();
    }
}
