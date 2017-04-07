<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemevaldoc extends Model
{
    protected $table = "itemevaldoc"; 
    protected $fillable = ['name', 'enable']; 

    public function evaldocs() { 
    	return $this->belongsToMany('tutoria\Evaldoc', 'evaldoc_item')->withPivot('escala')->withTimestamps(); 
    } 
}
