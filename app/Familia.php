<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = "familia"; 
    protected $fillable = ['num_mat', 'parentesco', 'pamano', 'edad']; 

    public function tutorando() { 
        return $this->belongsTo('tutoria\Tutorando', 'num_mat', 'num_mat'); 
    }
}
