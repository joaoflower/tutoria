<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemhobby extends Model
{
    protected $table = "itemhobby"; 
    protected $fillable = ['name', 'enable'];

    public function tutorandos() { 
    	return $this->belongsToMany('tutoria\Tutorando', 'tutorando_hob')->withPivot('enable')->withTimestamps(); 
    }
}
