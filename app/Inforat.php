<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Inforat extends Model
{
    protected $table = "inforat"; 
    protected $fillable = ['grupo_id', 'per_est', 'lec_apre', 'fecha']; 

    public function grupo() { 
    	return $this->belongsTo('tutoria\Grupo'); 
    } 

    public function inforatacas() { 
    	return $this->hasMany('tutoria\Inforataca'); 
    }
    public function inforatpers() { 
    	return $this->hasMany('tutoria\Inforatper'); 
    }
    public function inforatorgs() { 
    	return $this->hasMany('tutoria\Inforatorg'); 
    }

	public function actividades() { 
    	return $this->belongsToMany('tutoria\Actividad', 'inforat_acti')->withPivot('act_pro', 'act_eje', 'obs_act'); 
    }    
}
