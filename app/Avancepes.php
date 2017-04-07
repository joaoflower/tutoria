<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Avancepes extends Model
{
    protected $table = "avancepes"; 
    protected $fillable = ['name', 'enable']; 

    public function itaestus() { 
    	return $this->belongsToMany('tutoria\Itaestu', 'itaestu_avpes', 'avancepes_id', 'itaestu_id')->withPivot('eva_ava')->withTimestamps(); 
    } 
    public function itadocs() { 
    	return $this->belongsToMany('tutoria\Itadoc', 'itadoc_avpes', 'avancepes_id', 'itadoc_id')->withPivot('eva_ava')->withTimestamps(); 
    } 
}
