<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        //validacion de Datos
        $validate = $this->validate($request, [
            'image_id'=>'integer|required',
            'content'=>'string|required'
        ]);

        //Recoger Datos
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asigno los valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Guardar en la DB
        $comment->save();

        //redireccion
        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with([
                            'message' => 'Has publicado tu comentario correctamente'
                         ]);
    }

    public function delete($id){
        //conseguir datos usuario
        $user = Auth::user();

        //conseguir datos comment
        $comment = Comment::find($id);

        //comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                        ->with([
                            'message' => 'Comentario eliminado correctamente'
                        ]);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                        ->with([
                            'message' => 'El comentario no se ha eliminado correctamente'
                        ]);
        }
    }
}
