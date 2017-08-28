<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = "tutor"; 
    protected $primaryKey = 'cod_prf';
    protected $fillable = ['cod_car', 'paterno', 'materno', 'nombres', 'ayu_tutoria', 'celular', 'email', 'url', 'facebook', 'twitter', 'linkedin']; 
    public $incrementing = false;
    public $timestamps = true;

    public function docente() { 
        return $this->belongsTo('tutoria\Docente', 'cod_prf', 'cod_prf')->where('cod_car',$this->cod_car);
    }
}
