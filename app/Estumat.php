<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

use DB;

class Estumat extends Model
{
	protected $connection = "unapnet";
    protected $table = "estumat2018all"; 
    protected $fillable = ['num_mat', 'cod_car', 'ano_aca', 'per_aca', 'niv_est']; 
    protected $primaryKey = 'num_mat';

    public function estugrupos() { 
    	return $this->hasMany('tutoria\Estugrupo', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car); 
    }
    public function estudiante() { 
    	return $this->belongsTo('tutoria\Estudiante', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car);
    } 
    public static function getEstumats($cod_car) {
        $per_aca = "01";
        if($cod_car == '88') {
            return DB::connection('unapnet')
                ->table('estumat2018all')
                ->leftjoin('unapnet.estudiante', 'estumat2018all.num_mat', '=', 'estudiante.num_mat')
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                //->whereIn('estumat2016all.niv_est', ['01', '02']) // para alumnos de 1° y 2°
                ->whereIn('estumat2018all.niv_est', ['01'])
                ->whereIn('estumat2018all.cod_car', ['16', '17'])   
                ->where('estumat2018all.per_aca', $per_aca)          
                ->orderBy('paterno', 'asc')
                ->get();
        }
 /*      elseif($cod_car == '01') {
            return DB::connection('unapnet')
                ->table('estumat2017all')
                ->leftjoin('unapnet.estudiante', 'estumat2017all.num_mat', '=', 'estudiante.num_mat')
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                ->where('estumat2017all.cod_car', $cod_car)   
                ->where('estumat2017all.per_aca', $per_aca)          
                ->orderBy('paterno', 'asc')
                ->get();
        }*/
        else {
            return DB::connection('unapnet')
                ->table('estumat2018all')
                ->leftjoin('unapnet.estudiante', 'estumat2018all.num_mat', '=', 'estudiante.num_mat')
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                //->whereIn('estumat2016all.niv_est', ['01', '02'])
                ->whereIn('estumat2018all.niv_est', ['01'])
                ->where('estumat2018all.cod_car', $cod_car)  
                ->where('estumat2018all.per_aca', $per_aca)           
                ->orderBy('paterno', 'asc')
                ->get();
        }
    	
    }
    public static function getRegulares($cod_car) {
        $per_aca = "01";
        if($cod_car == '88' ) {
            return DB::connection('unapnet')
                ->table('estumat2018all')
                ->leftjoin('unapnet.estudiante', 'estumat2018all.num_mat', '=', 'estudiante.num_mat')
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                ->whereIn('estumat2018all.niv_est', ['02','03', '04','05','06','07','08','09','10','11','12'])
                ->whereIn('estumat2018all.cod_car', ['16', '17'])  
                ->where('estumat2018all.per_aca', $per_aca)           
                ->orderBy('paterno', 'asc')
                ->get();
        } else {            
            return DB::connection('unapnet')
                ->table('estumat2018all')
                ->leftjoin('unapnet.estudiante', 'estumat2018all.num_mat', '=', 'estudiante.num_mat')
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                ->whereIn('estumat2018all.niv_est', ['02','03', '04','05','06','07','08','09','10','11','12'])
                ->where('estumat2018all.cod_car', $cod_car)  
                ->where('estumat2018all.per_aca', $per_aca)           
                ->orderBy('paterno', 'asc')
                ->get();
        }
    }
    public static function getEstumat($num_mat) {
        return DB::connection('unapnet')
            ->table('estumat2018all')
            ->leftjoin('unapnet.estudiante', 'estumat2018all.num_mat', '=', 'estudiante.num_mat')
            ->leftjoin('unapnet.carrera', 'estumat2018all.cod_car', '=', 'carrera.cod_car')
            ->select('estudiante.num_mat', 'paterno', 'materno', 'nombres', 'car_des')
            ->where('estumat2018all.num_mat', $num_mat)
            ->first();
    }
    public static function getCod_car($num_mat) {
        return DB::connection('unapnet')
            ->table('estumat2018all')            
            ->select('cod_car')
            ->where('num_mat', $num_mat)
            ->first()
            ->cod_car;
    }
    public static function getCod_carR($num_mat) {
        return DB::connection('unapnet')
            ->table('estumat2018all')           
            ->select('cod_car')
            ->where('num_mat', $num_mat)
            ->first();
    }
    public static function getSingrupo($ano_aca, $per_aca) {

        return DB::connection('unapnet')
            ->table('estumat2018all')
            ->select('num_mat','cod_car')
            ->where('estumat2018all.per_aca', $per_aca)
            ->whereIn('estumat2018all.niv_est', ['01','02','03','04'])
            ->whereNotIn('estumat2018all.num_mat', function($que) {
                $que->select('num_mat')->from('tutoria.estugrupo');
            })
            ->get();

            /*->table('estugrupo')
            ->leftjoin('grupo', 'estugrupo.grupo_id', '=', 'grupo.id')
            ->select('estugrupo.id', 'num_mat')
            ->where('grupo.ano_aca', '=', $ano_aca)
            ->where('grupo.per_aca', '=', $per_aca)
            ->whereNotIn('estugrupo.id', function($que) {
                $que->select('estugrupo_id')->from('sesindi17');
            })
            ->get();*/
    }
}
