<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Evalses extends Model
{
    protected $table = "evalses"; 
    protected $fillable = ['name']; 

    public function sesgrus() { 
    	return $this->hasMany('tutoria\Sesgru'); 
    }
    public function sesgruases() { 
    	return $this->hasMany('tutoria\Sesgruase'); 
    }
    public function sesindis() { 
    	return $this->hasMany('tutoria\Sesindi'); 
    }
}
