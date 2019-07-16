<?php

namespace App\bancomer;

use Illuminate\Database\Eloquent\Model;

class Automatizar extends Model
{
    protected $table = 'automatizar';
	protected $fillable = [
    	'estado','tipo','subtipo'
    ];
}
