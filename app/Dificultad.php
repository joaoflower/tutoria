<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Dificultad extends Model
{
    protected $table = "dificultad"; 
    protected $fillable = ['name', 'enable']; 

    public function itaestus() { 
    	return $this->belongsToMany('tutoria\Itaestu', 'itaestu_dific', 'dificultad_id', 'itaestu_id')->withPivot('eva_dif')->withTimestamps(); 
    } 
    public function itadocs() { 
    	return $this->belongsToMany('tutoria\Itadoc', 'itadoc_dific', 'dificultad_id', 'itadoc_id')->withPivot('eva_dif')->withTimestamps(); 
    } 
}
