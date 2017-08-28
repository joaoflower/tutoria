<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Planactividad extends Model
{
    protected $table = "planactividad"; 
    protected $primaryKey = 'id';
    protected $fillable = ['objetivo_id', 'uni_med', 'meta', 'mes1', 'mes2', 'mes3', 'mes4', 'mes5', 'responsable']; 
    public $incrementing = true;
    public $timestamps = true;

    public function objetivo() { 
        return $this->belongsTo('tutoria\Planobjetivo', 'objetivo_id'); 
    }
}
