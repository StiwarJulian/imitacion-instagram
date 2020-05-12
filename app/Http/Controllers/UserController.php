<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	public function config()
	{
		return view('user.config');
	}

	public function updateConfig(Request $request, $id)
	{


		$user = \Auth::user();

		//Validacion Formulario
		$validate = $this->validate($request, [
			'name' => ['required', 'string', 'max:255'],
			'surname' => ['required', 'string', 'max:255'],
			'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $id],
			'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email,' . $id],
		]);


		$name = $request->input('name');
		$surname = $request->input('surname');
		$nick = $request->input('nick');
		$email = $request->input('email');

		// SETEAR DATOS DEL MODELO
		$user->name = $name;
		$user->surname = $surname;
		$user->nick = $nick;
		$user->email = $email;

		// GUARDAR IMAGEN
		$image_path = $request->file('image_path');
		if($image_path){
			$image_path_name = time().$image_path->getClientOriginalName();

			Storage::disk('users')->put($image_path_name, File::get($image_path));

			$user->image = $image_path_name;
		}

		// ACTUALIZAR USUARIO
		$user->update();

		return redirect()->route('user.config')->with(['message' => 'Usuario Actualizado Correctamente']);

	}

	public function getImage($filename){
		$file = Storage::disk('users')->get($filename);

		return new Response($file,200);
	}
}
