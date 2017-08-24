<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Tutorado extends Model
{
    protected $table = "tutorado"; 
    protected $primaryKey = 'num_mat';
    protected $fillable = ['cod_car', 'paterno', 'materno', 'nombres', 'fec_nac', 'emer_nom', 'emer_cel', 'disca_if', 'disca_des', 'enfer_if', 'enfer_des', 'salud_if', 'salud_des', 'pro_dep', 'pro_pro', 'pro_dis', 'com_par', 'con_vive', 'resi_dir', 'resi_ref', 'resi_tipo', 'depe_eco', 'situ_aca', 'ayu_tutoria', 'celular', 'email', 'url', 'facebook', 'twitter', 'linkedin', 'skype', 'instagram']; 
    public $incrementing = false;
    public $timestamps = true;

    public function estudiante() { 
        return $this->belongsTo('tutoria\Estudiante', 'num_mat', 'num_mat')->where('cod_car',$this->cod_car);
    }
    public function familias() {
        return $this->hasMany('tutoria\Familia', 'num_mat', 'num_mat'); 
    }
    public function itemhabitos() { 
        return $this->belongsToMany('tutoria\Itemhabito', 'tutorando_hab', 'num_mat', 'habito_id')->withPivot('enable')->withTimestamps(); 
    }
    public function itemhobbies() { 
        return $this->belongsToMany('tutoria\Itemhobby', 'tutorando_hob', 'num_mat', 'hobby_id')->withPivot('enable')->withTimestamps(); 
    }

}
