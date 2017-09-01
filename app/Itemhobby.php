<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Itemhobby extends Model
{
    protected $table = "itemhobby"; 
    protected $fillable = ['name', 'enable'];

    public function tutorados() { 
    	return $this->belongsToMany('tutoria\Tutorado', 'tutorado_hob')->withPivot('enable')->withTimestamps(); 
    }
}
