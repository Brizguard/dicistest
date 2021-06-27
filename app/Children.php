<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
	protected $fillable = [
		'first_name',
		'second_name',
		'surname',
		'parent_id',
		'email',
		'birthday',
	];
}
