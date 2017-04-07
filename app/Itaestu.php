<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itaestu extends Model
{
    protected $table = "itaestu"; 
    protected $fillable = ['estugrupo_id', 'mesita_id', 'res_dif', 'rec_sug', 'fecha']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    } 
    public function mesita() { 
    	return $this->belongsTo('tutoria\Mesita'); 
    } 
    
    public function dificultades() { 
    	return $this->belongsToMany('tutoria\Dificultad', 'itaestu_dific', 'itaestu_id', 'dificultad_id')->withPivot('eva_dif')->withTimestamps();
    }
    public function avanceacas() { 
    	return $this->belongsToMany('tutoria\Avanceaca', 'itaestu_avaca', 'itaestu_id', 'avanceaca_id')->withPivot('eva_ava')->withTimestamps(); 
    }
    public function avancepess() { 
    	return $this->belongsToMany('tutoria\Avancepes', 'itaestu_avpes', 'itaestu_id', 'avancepes_id')->withPivot('eva_ava')->withTimestamps();
    }
}
