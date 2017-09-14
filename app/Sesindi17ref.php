<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesindi17ref extends Model
{
    protected $table = "sesindi17_ref"; 
    protected $primaryKey = 'id';
    protected $fillable = ['sesindi_id', 'referido_id', 'enable'];
    public $incrementing = true;
    public $timestamps = true;

    public function sesindi17() { 
    	return $this->belongsTo('tutoria\Sesindi17', 'sesindi_id');
    }
    public function itemreferido() { 
        return $this->belongsTo('tutoria\Itemreferido', 'referido_id');
    }
    public function atencionref() { 
    	return $this->hasOne('tutoria\Atencionref', 'sesindiref_id');
    }
}
