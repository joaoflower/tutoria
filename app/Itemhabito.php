<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemhabito extends Model
{
    protected $table = "itemhabito"; 
    protected $fillable = ['name', 'enable'];

    public function tutorados() { 
    	return $this->belongsToMany('tutoria\Tutorado', 'tutorado_hab')->withPivot('enable')->withTimestamps(); 
    }
}
