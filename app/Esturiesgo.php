<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

use DB;

class Esturiesgo extends Model
{
    protected $connection = "unapnet";
    protected $table = "esturiesgo"; 
    protected $primaryKey = 'num_mat';
    protected $fillable = ['ano_aca', 'per_aca', 'cod_car', 'pln_est', 'riesgo_tipo_id']; 
    public $incrementing = false;
    public $timestamps = false;

    public static function getEsturiesgo( $ano_aca, $per_aca, $cod_car ) {
        if($cod_car == '88' ) {
            return DB::connection('unapnet')                                
                ->table('esturiesgo')
                ->leftjoin('unapnet.estudiante', 'esturiesgo.num_mat', '=', 'estudiante.num_mat')                
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')
                ->whereIn('esturiesgo.cod_car', ['16', '17'])  
                ->where('esturiesgo.ano_aca', $ano_aca)
                ->where('esturiesgo.per_aca', $per_aca)
                ->orderBy('paterno', 'asc')
                ->get();
        } else {            
            return DB::connection('unapnet')                                
                ->table('esturiesgo')
                ->leftjoin('unapnet.estudiante', 'esturiesgo.num_mat', '=', 'estudiante.num_mat')                
                ->select('estudiante.num_mat', 'estudiante.cod_car', 'paterno', 'materno', 'nombres')            
                ->where('esturiesgo.cod_car', $cod_car)  
                ->where('esturiesgo.ano_aca', $ano_aca)
                ->where('esturiesgo.per_aca', $per_aca)
                ->orderBy('paterno', 'asc')
                ->get();
        }
    }
    public static function getCod_carR($num_mat) {
        return DB::connection('unapnet')
            ->table('esturiesgo')            
            ->select('cod_car')
            ->where('num_mat', $num_mat)
            ->first();
    }
}
