<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = "actividad"; 
    protected $fillable = ['name', 'enable']; 

    public function inforats() { 
    	return $this->belongsToMany('tutoria\Inforat', 'inforat_acti')->withPivot('act_pro', 'act_eje', 'obs_act')->withTimestamps(); 
    } 
}
