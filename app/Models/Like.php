<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

	protected $table = 'likes';

	protected $fillable = [
		'user_id', 'image_id',
	];

	// RELATION MANY TO ONE
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	// RELATION MANY TO ONE
	public function image()
	{
		return $this->belongsTo('App\Models\Image', 'image_id');
	}
}
