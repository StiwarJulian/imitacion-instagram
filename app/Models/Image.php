<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = 'images';

	protected $fillable = [
		'user_id', 'image_path', 'description'
	];

	// RELACION ONE TO MANY COMMENTS
	public function comment()
	{
		return $this->hasMany('App\Models\Comment', 'image_id');
	}

	// RELATION ONE TO MANY (hasMany) Likes
	public function like()
	{
		return $this->hasMany('App\Models\Like', 'image_id');
	}

	// RELATION MANY TO ONE (belognsTo) Users
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}
}
