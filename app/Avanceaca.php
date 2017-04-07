<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Avanceaca extends Model
{
    protected $table = "avanceaca"; 
    protected $fillable = ['name', 'enable']; 

    public function itaestus() { 
    	return $this->belongsToMany('tutoria\Itaestu', 'itaestu_avaca', 'avanceaca_id', 'itaestu_id')->withPivot('eva_ava')->withTimestamps(); 
    } 
    public function itadocs() { 
    	return $this->belongsToMany('tutoria\Itadoc', 'itadoc_avaca', 'avanceaca_id', 'itadoc_id')->withPivot('eva_ava')->withTimestamps(); 
    } 
}
