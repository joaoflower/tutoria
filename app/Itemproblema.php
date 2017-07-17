<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemproblema extends Model
{
    protected $table = "itemproblema"; 
    protected $fillable = ['name', 'enable'];

    public function areaproblema() { 
    	return $this->belongsTo('tutoria\Areaproblema'); 
    }
    public function sesindi17s() { 
    	return $this->belongsToMany('tutoria\Sesindi17', 'sesindi17_pro')->withPivot('enable')->withTimestamps(); 
    }
}
