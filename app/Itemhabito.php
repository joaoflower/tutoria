<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemhabito extends Model
{
    protected $table = "itemhabito"; 
    protected $fillable = ['name', 'enable'];

    public function tutorandos() { 
    	return $this->belongsToMany('tutoria\Tutorando', 'tutorando_hab')->withPivot('enable')->withTimestamps(); 
    }
}
