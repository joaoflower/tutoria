<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = "comunicado"; 
    protected $primaryKey = 'id';
    protected $fillable = ['usutut_id', 'cod_car', 'ano_aca', 'per_aca', 'para', 'asunto', 'mensaje', 'enable']; 
    public $incrementing = true;
    public $timestamps = true;

    public function users() { 
        return $this->belongsTo('tutoria\User', 'usutut_id'); 
    }
}
