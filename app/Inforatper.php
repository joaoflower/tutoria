<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Inforatper extends Model
{
    protected $table = "inforatper"; 
    protected $fillable = ['inforat_id', 'log_per', 'dif_per']; 

    public function inforat() { 
    	return $this->belongsTo('tutoria\Inforat'); 
    } 
}
