<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemaspecto18 extends Model
{
    protected $table = "itemaspecto"; 
    protected $fillable = ['name', 'enable'];

    public function areaproblema() { 
    	return $this->belongsTo('tutoria\Areaspecto'); 
    }
    public function encusatis() { 
    	return $this->belongsToMany('tutoria\Encusati18', 'encusati18_aspecto')->withPivot('evalaspecto_id')->withTimestamps(); 
    }
}
