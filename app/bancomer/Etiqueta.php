<?php

namespace App\bancomer;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table = 'etiqueta';

    protected $fillable = [
        'descripcion','tipo'
    ];

    public function personal() {
    	return $this->belongsToMany('App\bancomer\Personal','tag_bancomer_personal');
	}
}