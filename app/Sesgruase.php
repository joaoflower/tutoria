<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesgruase extends Model
{
    protected $table = "sesgruase"; 
    protected $fillable = ['sesgru_id', 'estugrupo_id', 'asi_est', 'evalses_id']; 

    public function sesgru() { 
    	return $this->belongsTo('tutoria\Sesgru'); 
    } 
    public function estugrupo() { 
    	return $this->belongsTo('tutoria\Estugrupo'); 
    }
    public function evalses() { 
    	return $this->belongsTo('tutoria\Evalses'); 
    }
}
