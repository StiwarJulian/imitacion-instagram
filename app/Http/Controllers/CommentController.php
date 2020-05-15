<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function save(Request $request)
	{

		$validate = $this->validate($request, [
			'image_id' => ['integer', 'required'],
			'content' => ['string', 'required']
		]);

		$image_id = $request->input('image_id');
		$content = $request->input('content');
		$user_id = \Auth::user()->id;

		$comment = new Comment();
		$comment->user_id = $user_id;
		$comment->image_id = $image_id;
		$comment->content = $content;

		$comment->save();

		return redirect()->route('image.detail', ['id' => $image_id]);
	}

	public function delete($id)
	{

		$user = \Auth::user();
		$comment = Comment::find($id);

		if ($user && ($user->id == $comment->user_id || $comment->image->user_id == $user->id)) {
			$comment->delete();

			return redirect()->route('image.detail', ['id' => $comment->image->id])->with([
				"message" => 'Comentario eliminado correctamente',
				"status" => 200
			]);
		} else {
			return redirect()->route('image.detail', ['id' => $comment->image->id])->with([
				"message" => 'no se ha podido borrar el mensaje',
				"status" => 500
			]);
		}
	}
}
