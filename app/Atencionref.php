<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Atencionref extends Model
{
    protected $table = "atencionref"; 
    protected $primaryKey = 'id';
    protected $fillable = ['sesindiref_id', 'usutut_id', 'atendido', 'fecha', 'recomendacion'];
    public $incrementing = true;
    public $timestamps = true;

    public function sesindi17ref() { 
    	return $this->belongsTo('tutoria\Sesindi17ref', 'sesindiref_id');
    }
    public function seguimientoref() { 
    	return $this->hasOne('tutoria\Seguimientoref', 'atencionref_id');
    }
}
