<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Evaldoc extends Model
{
    protected $table = "evaldoc"; 
    protected $fillable = ['estugrupo_id', 'obs_sug']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    } 
    
    public function itemevaldocs() { 
    	return $this->belongsToMany('tutoria\Itemevaldoc', 'evaldoc_item', 'evaldoc_id', 'itemeval_id')->withPivot('escala')->withTimestamps(); 
    }
}
