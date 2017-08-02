<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Areaspecto extends Model
{
    protected $table = "areaspecto"; 
    protected $fillable = ['name', 'enable'];

    public function itemaspectos() { 
    	return $this->hasMany('tutoria\Itemaspecto'); 
    }
}
