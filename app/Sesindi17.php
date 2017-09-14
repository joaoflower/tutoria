<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesindi17 extends Model
{
    protected $table = "sesindi17"; 
    protected $fillable = ['estugrupo_id', 'nro_ses', 'pro_ide', 'fecha']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    }
    public function itemproblemas() { 
    	return $this->belongsToMany('tutoria\Itemproblema', 'sesindi17_pro', 'sesindi_id', 'problema_id')->withPivot('enable')->withTimestamps(); 
    }
    public function itemreferidos() { 
    	return $this->belongsToMany('tutoria\Itemreferido', 'sesindi17_ref', 'sesindi_id', 'referido_id')->withPivot('enable')->withTimestamps(); 
    }
    public function encusatis() { 
        return $this->hasMany('tutoria\Encusati'); 
    }    
    public function sesindi17refs() { 
        return $this->hasMany('tutoria\Sesindi17ref', 'sesindi_id'); 
    }
}
