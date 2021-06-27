<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = [
    	'first_name',
		'second_name',
		'surname',
		'email',
		'birthday',
		'auto',
		'mark',
		'model',
	];

}
