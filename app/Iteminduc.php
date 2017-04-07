<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Iteminduc extends Model
{
    protected $table = "iteminduc"; 
    protected $fillable = ['name', 'enable']; 

    public function inducciones() { 
    	return $this->belongsToMany('tutoria\Induccion', 'induccion_item', 'item_id', 'induccion_id')->withPivot('eva_ind')->withTimestamps(); 
    } 
}
