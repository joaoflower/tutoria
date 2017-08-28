<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Planobjetivo extends Model
{
    protected $table = "planobjetivo"; 
    protected $primaryKey = 'id';
    protected $fillable = ['plan_id', 'objetivo']; 
    public $incrementing = true;
    public $timestamps = true;

    public function actividades() {
        return $this->hasMany('tutoria\Planactividad', 'objetivo_id'); 
    }
    public function plan() { 
        return $this->belongsTo('tutoria\Plan', 'plan_id'); 
    }
}
