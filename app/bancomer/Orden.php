<?php

namespace App\bancomer;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';

    protected $fillable = [
        'descripcion','tipo'
    ];
}
