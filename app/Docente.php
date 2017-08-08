<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;
use DB;

class Docente extends Model
{
	protected $connection = "unapnet";
    protected $table = "docente"; 
    protected $fillable = ['cod_prf', 'cod_car', 'paterno', 'materno', 'nombres']; 

    public function grupos() { 
    	return $this->hasMany('tutoria\Grupo', 'cod_prf', 'cod_prf'); 
    } 
    public function carrera() { 
    	return $this->belongsTo('tutoria\Carrera', 'cod_car', 'cod_car'); 
    } 

    public static function getDocentes($cod_car) {
    	//return Docente::where('cod_car', $cod_car)->get();
        if($cod_car == '88') {
            return DB::connection('unapnet')
                ->table('docente')
                ->select('cod_prf', 'cod_car', 'paterno', 'materno', 'nombres')
                //->where('cod_car', $cod_car) // la misma carrera que es definido
                ->whereIn('cod_car', ['16', '17', '87','88'])
                ->where('cnd_act', '1')
                ->orderBy('paterno', 'asc')
                ->get();
        }
        else {
            return DB::connection('unapnet')
                ->table('docente')
                ->select('cod_prf', 'cod_car', 'paterno', 'materno', 'nombres')
                //->where('cod_car', $cod_car)
                ->whereIn('cod_car', [$cod_car, '87'])
                ->where('cnd_act', '1')
                ->orderBy('paterno', 'asc')
                ->get();
        }

    }
    public static function getDocente($cod_prf) {
        return DB::connection('unapnet')
            ->table('docente')
            ->leftjoin('unapnet.carrera', 'docente.cod_car', '=', 'carrera.cod_car')
            ->select('cod_prf', 'paterno', 'materno', 'nombres', 'car_des')
            ->where('cod_prf', $cod_prf)
            ->where('cnd_act', '1')
            ->first();
    }
    public static function getName($cod_prf) {
        if($cod_prf == '999999') {
            return "PASTORAL UNIVERSITARIA";
        } elseif ($cod_prf == '999998') {
            return "PSICOPEDAGOGIA";
        } else {
            $docente = Docente::getDocente($cod_prf);
            return $docente->paterno.' '.$docente->materno.', '.$docente->nombres;
        }
        
    }
}
