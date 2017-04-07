<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Mesita extends Model
{
    protected $table = "mesita"; 
    protected $fillable = ['mes1', 'mes2', 'ano_aca', 'per_aca', 'enable']; 

    public function names1() { 
    	return $this->belongsTo('tutoria\Mes', 'mes1', 'id');  
    }
    public function names2() { 
    	return $this->belongsTo('tutoria\Mes', 'mes2', 'id'); 
    }

    public function itaestus() { 
    	return $this->hasMany('tutoria\Itaestu'); 
    }
    public function itadocs() { 
    	return $this->hasMany('tutoria\Itadoc'); 
    }
}
