<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function __Construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['required'], ['image'],
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $image = new Image();
        $image->user_id = \Auth::user()->id;
        $image->image_path = null;
        $image->description = $description;

        //subir imagen

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            "message" => "La foto ha sido subida correctamente",
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function details($id)
    {
        $image = Image::find($id);
        return view('image.detail', [
            'image' => $image,
        ]);
    }

    public function delete($id)
    {
        $user = \Auth::user();

        $images = Image::find($id);
        $comments = Comment::where('image_id', $images->id)->get();
        $likes = Like::where('image_id', $images->id)->get();

        if ($user && $images && ($images->user->id == $user->id)) {
            //eliminar comentarios
            if ($comments && count($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            // eliminar likes
            if ($likes && count($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // eliminar ficheros imagen
            Storage::disk('images')->delete($images->image_path);

            // eliminar imagen
            $images->delete();
            $message = 'la imagen se ha borrado';

        } else {
            $message = 'la imagen no se ha borrado';
        }

        return redirect()->route('home')->with([
            'message' => $message,
        ]);

    }

    public function edit($id)
    {
        $user = \Auth::user();
        $images = Image::find($id);

        if ($user && $images && ($images->user->id == $user->id)) {
            return view('image.edit', ['images' => $images]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request)
    {

        $validate = $this->validate($request, [
            'description' => ['required'],
            'image_path' => ['image'],
        ]);

        $image_id = $request->input('image_id');
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $image = Image::find($image_id);
        $image->description = $description;
        //subir imagen

        if ($image_path) {
            Storage::disk('images')->delete($image->image_path);
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));

            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id]);

    }
}
