<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;


	protected $fillable = [
		'role', 'name', 'surname', 'nick', 'email', 'password',
	];


	protected $hidden = [
		'password', 'remember_token',
	];

	//RELATION ONE TO MANY
	public function images()
	{
		return $this->hasMany('App\Models\Image', 'user_id');
	}
}
