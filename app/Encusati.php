<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Encusati extends Model
{
    protected $table = "encusati"; 
    protected $fillable = ['sesindi17_id', 'com_sug']; 

    public function sesindi17() { 
    	return $this->belongsTo('tutoria\Sesindi17'); 
    }
    public function itemaspectos() { 
    	return $this->belongsToMany('tutoria\Itemaspecto', 'encusati_aspecto', 'encusati_id', 'aspecto_id')->withPivot('evalaspecto_id')->withTimestamps(); 
    }
}
