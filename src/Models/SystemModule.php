<?php

namespace Idoneo\HumanoBilling\Models;

use Illuminate\Database\Eloquent\Model;

class SystemModule extends Model
{
	protected $table = 'modules';

	protected $fillable = [
		'name',
		'key',
		'icon',
		'description',
		'is_core',
		'status',
	];

	protected $casts = [
		'is_core' => 'boolean',
	];
}


