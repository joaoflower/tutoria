<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Inforatorg extends Model
{
    protected $table = "inforatorg"; 
    protected $fillable = ['inforat_id', 'log_org', 'dif_org']; 

    public function inforat() { 
    	return $this->belongsTo('tutoria\Inforat'); 
    } 
}
