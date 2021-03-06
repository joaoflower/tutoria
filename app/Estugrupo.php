<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;
use tutoria\Sesindi17;

use DB;

class Estugrupo extends Model
{
    protected $table = "estugrupo"; 
    protected $fillable = ['grupo_id', 'num_mat', 'cod_car']; 

    public function sesindis() { 
    	return $this->hasMany('tutoria\Sesindi'); 
    }
    public function sesindi17s() { 
        return $this->hasMany('tutoria\Sesindi17'); 
    }
    public function sesgru17avs() { 
        return $this->hasMany('tutoria\Sesgru17av', 'estugrupo_id'); 
    }
    public function induccion() { 
    	return $this->hasOne('tutoria\Induccion'); 
    }
    public function itaestus() { 
    	return $this->hasMany('tutoria\Itaestu'); 
    }
    public function itadocs() { 
    	return $this->hasMany('tutoria\Itadoc'); 
    }
    public function evalestu() { 
    	return $this->hasOne('tutoria\Evalestu'); 
    }
    public function evaldoc() { 
    	return $this->hasOne('tutoria\Evaldoc'); 
    }

    public function estumat() { 
    	return $this->belongsTo('tutoria\Estumat', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car); 
    } 
    public function grupo() { 
    	return $this->belongsTo('tutoria\Grupo'); 
    } 
    public static function getEstudiantes($grupo_id) {
        return DB::table('estugrupo')
            ->leftjoin('unapnet.estudiante', 'estugrupo.num_mat', '=', 'estudiante.num_mat')
            ->leftjoin('unapnet.carrera', 'estugrupo.cod_car', '=', 'carrera.cod_car')
            ->select('id', 'estugrupo.num_mat', 'paterno', 'materno', 'nombres', 'car_des')
            ->where('estugrupo.grupo_id', $grupo_id)
            ->orderBy('paterno', 'asc')
            ->get();
    }
    public static function getConTutor($cod_car, $ano_aca, $per_aca) {
        return DB::table('estugrupo')
            ->join('grupo', 'estugrupo.grupo_id', '=', 'grupo.id')
            ->where('grupo.cod_car', '=', $cod_car)
            ->where('grupo.ano_aca', '=', $ano_aca)
            ->where('grupo.per_aca', '=', $per_aca)
            ->select('num_mat')
            ->get();
    }
    public static function getConTutorAll($ano_aca, $per_aca) {
        return DB::table('estugrupo')
            ->join('grupo', 'estugrupo.grupo_id', '=', 'grupo.id')            
            ->where('grupo.ano_aca', '=', $ano_aca)
            ->where('grupo.per_aca', '=', $per_aca)
            ->select('num_mat')
            ->get();
    }
    public static function getSinSes($ano_aca, $per_aca) {

        return DB::table('estugrupo')
            ->leftjoin('grupo', 'estugrupo.grupo_id', '=', 'grupo.id')
            ->select('estugrupo.id', 'num_mat')
            ->where('grupo.ano_aca', '=', $ano_aca)
            ->where('grupo.per_aca', '=', $per_aca)
            ->whereNotIn('estugrupo.id', function($que) {
                $que->select('estugrupo_id')->from('sesindi17');
            })
            ->get();
        /*return DB::table('estugrupo')
            ->join('grupo', function($join) {
                $join->on('estugrupo.grupo_id', '=', 'grupo.id')
                    ->where('grupo.ano_aca', '=', $ano_aca)
                    ->where('grupo.per_aca', '=', $per_aca);
            })
            ->select('num_mat')
            ->get();*/
    }
}
