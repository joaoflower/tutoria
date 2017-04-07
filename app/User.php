<?php

namespace tutoria;

use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password', 'type', 'username', 'codigo', 'cod_car', 'paterno', 'materno', 'nombres',
    ];*/
    protected $table = 'usutut';
    protected $fillable = [
        'name', 'email', 'username', 'codigo', 'cod_car',  'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/
    protected $hidden = [
        'password', 
    ];
    public function docente() { 
        return $this->belongsTo('tutoria\Docente', 'codigo', 'cod_prf'); 
    } 
    public static function getHeads() {
        return DB::table('usutut')
            ->leftjoin('unapnet.carrera', 'usutut.cod_car', '=', 'carrera.cod_car')
            ->select('id', 'name', 'codigo', 'car_des')
            ->where('type', 'head')
            ->get();
            
    }
    /*
    //-------------------------------------------
    public function getRememberToken()
     {
       return null; // not supported
     }

     public function setRememberToken($value)
     {
       // not supported
     }

     public function getRememberTokenName()
     {
       return null; // not supported
     }

     public function setAttribute($key, $value)
     {
       $isRememberTokenAttribute = $key == $this->getRememberTokenName();
       if (!$isRememberTokenAttribute)
       {
         parent::setAttribute($key, $value);
       }
     }*/
    //-------------------------------------------



}
