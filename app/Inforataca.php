<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Inforataca extends Model
{
    protected $table = "inforataca"; 
    protected $fillable = ['inforat_id', 'log_aca', 'dif_aca']; 

    public function inforat() { 
    	return $this->belongsTo('tutoria\Inforat'); 
    } 
}
