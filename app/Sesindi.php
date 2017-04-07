<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesindi extends Model
{
    protected $table = "sesindi"; 
    protected $fillable = ['estugrupo_id', 'nro_ses', 'tem_aca', 'tem_per', 'pro_aca', 'pro_per', 'acu_aca', 'acu_per', 'obs_aca', 'obs_per', 'evalses_id', 'fecha']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    } 
    public function evalses() { 
    	return $this->belongsTo('tutoria\Evalses'); 
    }
}
