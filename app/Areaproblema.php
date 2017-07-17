<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Areaproblema extends Model
{
    protected $table = "areaproblema"; 
    protected $fillable = ['name', 'enable'];

    public function itemproblemas() { 
    	return $this->hasMany('tutoria\Itemproblema'); 
    }
}
