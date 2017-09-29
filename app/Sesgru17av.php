<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesgru17av extends Model
{
    protected $table = "sesgru17av"; 
    protected $primaryKey = 'id';
    protected $fillable = ['sesgru17_id', 'estugrupo_id', 'asi_est', 'valoracion']; 
    public $incrementing = true;
    public $timestamps = true;

    public function sesgru17() { 
        return $this->belongsTo('tutoria\Sesgru17', 'sesgru17_id'); 
    }
    public function estugrupo() { 
        return $this->belongsTo('tutoria\Estugrupo', 'estugrupo_id'); 
    }
}
