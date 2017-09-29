<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

use DB;

class Grupo extends Model
{
    protected $table = "grupo"; 
    protected $fillable = ['name', 'cod_prf', 'cod_car', 'ano_aca', 'per_aca']; 

    public function estugrupos() { 
    	return $this->hasMany('tutoria\Estugrupo'); 
    }
    public function sesgru17s() { 
    	return $this->hasMany('tutoria\Sesgru17', 'grupo_id'); 
    }
    public function inforats() { 
    	return $this->hasMany('tutoria\Inforat'); 
    }
    public function docente() { 
    	return $this->belongsTo('tutoria\Docente', 'cod_prf', 'cod_prf'); 
    } 
    public function carrera() { 
    	return $this->belongsTo('tutoria\Carrera', 'cod_car', 'cod_car'); 
    } 
    public static function getGrupos($ano_aca, $per_aca, $cod_car) {
        return DB::table('grupo')            
            ->select('id', 'name', 'paterno', 'materno', 'nombres')
            ->leftjoin('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            ->where('grupo.ano_aca', $ano_aca)
            ->where('grupo.per_aca', $per_aca)    // OJO: Los periodos ya no se consideran
            ->where('grupo.cod_car', $cod_car)
            ->orderBy('paterno', 'ASC')
            //->paginate(10);
            ->get();
    }
    public static function getGrupoEstu($ano_aca, $per_aca, $cod_car) {
        # Muy lento
        return DB::table('grupo')            
            ->select('grupo.id', 'grupo.cod_prf', 'docente.paterno', 'docente.materno', 'docente.nombres', 'estugrupo.num_mat', 'estudiante.paterno', 'estudiante.materno', 'estudiante.nombres')
            ->join('unapnet.docente', 'grupo.cod_prf', '=', 'docente.cod_prf')
            ->join('estugrupo', 'grupo.id', '=', 'estugrupo.grupo_id')
            ->join('unapnet.estudiante', 'estugrupo.num_mat', '=', 'estudiante.num_mat')
            ->where('grupo.ano_aca', $ano_aca)
            ->where('grupo.per_aca', $per_aca)    // OJO: Los periodos ya no se consideran
            ->where('grupo.cod_car', $cod_car)
            ->orderBy('grupo.id', 'ASC')
            //->paginate(10);
            ->get();
    }
    public static function getByDocente($ano_aca, $per_aca, $cod_car, $cod_prf) {
        return DB::table('grupo')            
            ->select('id')
            ->where('grupo.ano_aca', $ano_aca)
            ->where('grupo.per_aca', $per_aca)    // OJO: Los periodos ya no se consideran
            ->where('grupo.cod_car', $cod_car)
            ->where('grupo.cod_prf', $cod_prf)
            ->first();
    }
}
