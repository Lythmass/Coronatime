<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	use HasFactory;

	protected $fillable = [
		'code',
		'en',
		'ka',
	];

	protected $table = 'countries';

	public function statistic()
	{
		return $this->hasOne(Statistic::class, 'code', 'code');
	}
}
