<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Induccion extends Model
{
    protected $table = "induccion"; 
    protected $fillable = ['estugrupo_id', 'tem_pro', 'fecha']; 

    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    } 
    
    public function iteminducs() { 
    	return $this->belongsToMany('tutoria\Iteminduc', 'induccion_item', 'induccion_id', 'item_id')->withPivot('eva_ind')->withTimestamps();
    }
    public function procinducs() { 
    	return $this->belongsToMany('tutoria\Procinduc', 'induccion_proc', 'induccion_id', 'proc_id')->withPivot('eva_ind')->withTimestamps(); 
    }
}
