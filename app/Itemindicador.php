<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemindicador extends Model
{
    protected $table = "itemindicador"; 
    protected $primaryKey = 'id';
    protected $fillable = ['factor_id', 'name', 'enable'];
    public $incrementing = true;
    public $timestamps = true;

    public function itemfactor() { 
    	return $this->belongsTo('tutoria\Itemfactor', 'factor_id'); 
    }
    public function planfactores() { 
        return $this->belongsToMany('tutoria\Planfactor', 'planfactor_indicador')->withPivot('data', 'meta', 'problema', 'causa', 'alternativa', 'objetivo')->withTimestamps(); 
    }
}
