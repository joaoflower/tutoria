<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemreferido extends Model
{
    protected $table = "itemreferido"; 
    protected $fillable = ['name', 'enable'];

    public function sesindi17s() { 
    	return $this->belongsToMany('tutoria\Sesindi17', 'sesindi17_ref')->withPivot('enable')->withTimestamps(); 
    }
}
