<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesgru extends Model
{
    protected $table = "sesgru"; 
    protected $fillable = ['grupo_id', 'nro_ses', 'tem_ses', 'pro_ses', 'acu_ses', 'obs_ses', 'evalses_id', 'fecha']; 

    public function grupo() { 
    	return $this->belongsTo('tutoria\Grupo'); 
    } 
    public function evalses() { 
    	return $this->belongsTo('tutoria\Evalses'); 
    }
    public function sesgruases() { 
    	return $this->hasMany('tutoria\Sesgruase'); 
    }
}
