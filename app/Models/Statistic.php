<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	use HasFactory;

	protected $fillable = [
		'country',
		'code',
		'confirmed',
		'recovered',
		'death',
		'country_id',
	];

	protected $table = 'statistics';

	public function getCountry()
	{
		return $this->belongsTo(Country::class, 'country_id');
	}
}
