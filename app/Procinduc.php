<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Procinduc extends Model
{
    protected $table = "procinduc"; 
    protected $fillable = ['name', 'enable']; 

    public function inducciones() { 
    	return $this->belongsToMany('tutoria\Induccion', 'induccion_proc', 'proc_id', 'induccion_id')->withPivot('eva_ind')->withTimestamps(); 
    } 
}
