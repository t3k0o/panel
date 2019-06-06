<?php

namespace App\bancomer;

use Illuminate\Database\Eloquent\Model;

class Etiqueta_Personal extends Model
{
    protected $table = 'tag_bancomer_personal';
    public $timestamps = false;
    protected $fillable = [
        'etiqueta_id','personal_id'
    ];
}
