<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Seguimientoref extends Model
{
    protected $table = "seguimientoref"; 
    protected $primaryKey = 'id';
    protected $fillable = ['atencionref_id', 'fecha', 'recomendacion'];
    public $incrementing = true;
    public $timestamps = true;

    public function atencionref() { 
    	return $this->belongsTo('tutoria\Atencionref', 'atencionref_id');
    }
}