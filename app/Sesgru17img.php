<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Sesgru17img extends Model
{
    protected $table = "sesgru17img"; 
    protected $primaryKey = 'id';
    protected $fillable = ['sesgru17_id', 'url', 'size', 'mime']; 
    public $incrementing = true;
    public $timestamps = true;

    public function sesgru17() { 
        return $this->belongsTo('tutoria\Sesgru17', 'sesgru17_id'); 
    }
}
