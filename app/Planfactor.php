<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Planfactor extends Model
{
    protected $table = "planfactor"; 
    protected $primaryKey = 'id';
    protected $fillable = ['plan_id', 'factor_id', 'objetivo', 'fortaleza'];
    public $incrementing = true;
    public $timestamps = true;

    public function plan() { 
    	return $this->belongsTo('tutoria\Plan', 'plan_id'); 
    }
    public function itemfactor() { 
    	return $this->belongsTo('tutoria\Itemfactor', 'factor_id'); 
    }    
    public function itemindicadores() { 
    	return $this->belongsToMany('tutoria\Itemindicador', 'planfactor_indicador', 'planfactor_id', 'indicador_id')->withPivot('data', 'meta', 'problema', 'causa', 'alternativa')->withTimestamps();    # Borrar objetivo
    }
    public function actividades() {
        return $this->hasMany('tutoria\Planactividad', 'planfactor_id'); 
    }
}
