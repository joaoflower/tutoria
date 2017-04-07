<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemevalestu extends Model
{
    protected $table = "itemevalestu"; 
    protected $fillable = ['name', 'enable']; 

    public function evalestus() { 
    	return $this->belongsToMany('tutoria\Evalestu', 'evalestu_item')->withPivot('escala')->withTimestamps(); 
    } 
}
