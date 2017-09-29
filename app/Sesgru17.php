<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesgru17 extends Model
{
    protected $table = "sesgru17"; 
    protected $primaryKey = 'id';
    protected $fillable = ['grupo_id', 'nro_ses', 'fecha']; 
    public $incrementing = true;
    public $timestamps = true;

    public function grupo() { 
        return $this->belongsTo('tutoria\Grupo', 'grupo_id'); 
    }
    public function sesgru17avs() { 
    	return $this->hasMany('tutoria\Sesgru17av', 'sesgru17_id'); 
    }
    public function sesgru17imgs() {
        return $this->hasMany('tutoria\Sesgru17img', 'sesgru17_id'); 
    }
}
