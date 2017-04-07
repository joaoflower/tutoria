<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    protected $table = "mes"; 
    protected $fillable = ['name']; 

    public function meses1() { 
    	return $this->hasMany('tutoria\Mesita', 'mes1', 'id'); # Modelo Foreign, campo del modelo Foreign, campo id del modelo actual
    }
    public function meses2() { 
    	return $this->hasMany('tutoria\Mesita', 'mes2', 'id'); 
    }
}
