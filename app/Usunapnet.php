<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Usunapnet extends Model
{
    protected $table = "usunapnet"; 
    protected $fillable = ['name', 'email', 'username', 'codigo', 'cod_car','passwd', 'type']; 
}
