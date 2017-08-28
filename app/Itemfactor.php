<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemfactor extends Model
{
    protected $table = "itemfactor"; 
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'enable'];
    public $incrementing = true;
    public $timestamps = true;
    
    public function itemindicadores() { 
    	return $this->hasMany('tutoria\Itemindicador', 'factor_id'); 
    }
    public function planfactores() { 
    	return $this->hasMany('tutoria\Planfactor', 'factor_id'); 
    }
}
