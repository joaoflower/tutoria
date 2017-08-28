<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plan"; 
    protected $primaryKey = 'id';
    protected $fillable = ['cod_car', 'ano_aca', 'per_aca', 'evaluacion', 'asistentes']; 
    public $incrementing = true;
    public $timestamps = true;

    public function planfactores() { 
    	return $this->hasMany('tutoria\Planfactor', 'plan_id'); 
    }
    public function objetivos() {
        return $this->hasMany('tutoria\Planobjetivo', 'plan_id'); 
    }
}
