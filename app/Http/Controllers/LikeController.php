<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function like($id)
	{
		$user = \Auth::user();

		$isset_like = Like::where('user_id', $user->id)
			->where('image_id', $id)->count();

		if ($isset_like == 0) {
			$like = new Like();
			$like->user_id = $user->id;
			$like->image_id = (int) $id;

			$like->save();

			return response()->json([
				'like' => $like
			]);
		} else {
			return response()->json([
				"message" => 'El like ya existe'
			]);
		}
	}

	public function dislike($id)
	{
		$user = \Auth::user();

		$like = Like::where('user_id', $user->id)
			->where('image_id', $id)->first();

		if ($like) {

			$like->delete();

			return response()->json([
				'like' => $like,
				'message' => 'haz dado dislike correctamente'
			]);
		} else {
			return response()->json([
				"message" => 'El like no existe'
			]);
		}
	}
}
