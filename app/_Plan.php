<?php

namespace tutoria;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plan"; 
    protected $primaryKey = 'id';
    protected $fillable = ['cod_car', 'ano_aca', 'per_aca', 'peasa_data', 'peasa_meta', 'peasa_pro','peasa_cau', 'peasa_alt', 'peasa_obj', 'nera_data', 'nera_meta', 'nera_pro', 'nera_cau', 'nera_alt', 'nera_obj', 'ntama_data', 'ntama_meta', 'ntama_pro', 'ntama_cau', 'ntama_alt', 'ntama_obj', 'paste_for', 'pepmsl_data', 'pepmsl_meta', 'pepmsl_pro', 'pepmsl_cau', 'pepmsl_alt', 'pepmsl_obj', 'pemcsa_data', 'pemcsa_meta', 'pemcsa_pro', 'pemcsa_cau', 'pemcsa_alt', 'pemcsa_obj', 'nerif5_data', 'nerif5_meta', 'nerif5_pro', 'nerif5_cau', 'nerif5_alt', 'nerif5_obj', 'pseuna_for', 'pstgd_data', 'pstgd_meta', 'pstgd_pro', 'pstgd_cau', 'pstgd_alt', 'pstgd_obj', 'pstid1_data', 'pstid1_meta', 'pstid1_pro', 'pstid1_cau', 'pstid1_alt', 'pstid1_obj', 'pssieraa_data', 'pssieraa_meta', 'pssieraa_pro', 'pssieraa_cau', 'pssieraa_alt', 'pssieraa_obj', 'pssierae_data', 'pssierae_meta', 'pssierae_pro', 'pssierae_cau', 'pssierae_alt', 'pssierae_obj', 'pr3pmf_data', 'pr3pmf_meta', 'pr3pmf_pro', 'pr3pmf_cau', 'pr3pmf_alt', 'pr3pmf_obj', 'patppne_data', 'patppne_meta', 'patppne_pro', 'patppne_cau', 'patppne_alt', 'patppne_obj', 'gbeu_for', 'prgtep_data', 'prgtep_meta', 'prgtep_pro', 'prgtep_cau', 'prgtep_alt', 'prgtep_obj', 'nedsau_data', 'nedsau_meta', 'nedsau_pro', 'nedsau_cau', 'nedsau_alt', 'nedsau_obj', 'neapaa_data', 'neapaa_meta', 'neapaa_pro', 'neapaa_cau', 'neapaa_alt', 'neapaa_obj', 'nsecast_data', 'nsecast_meta', 'nsecast_pro', 'nsecast_cau', 'nsecast_alt', 'nsecast_obj', 'amptu_for', 'evaluacion', 'asistentes']; 
    public $incrementing = true;
    public $timestamps = true;

    public function objetivos() {
        return $this->hasMany('tutoria\Planobjetivo', 'plan_id'); 
    }
}
