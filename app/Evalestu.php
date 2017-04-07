<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Evalestu extends Model
{
    protected $table = "evalestu"; 
    protected $fillable = ['estugrupo_id', 'obs_sug']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    } 
    
    public function itemevalestus() { 
    	return $this->belongsToMany('tutoria\Itemevalestu', 'evalestu_item', 'evalestu_id', 'itemeval_id')->withPivot('escala')->withTimestamps(); 
    }
}
