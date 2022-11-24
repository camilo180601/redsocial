<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user = Auth::user();

        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('like.index',[
            'likes' => $likes
        ]);

    }

    public function like($image_id){

        //recoger datos del usuaruio e imagen
        $user = Auth::user();

        //Comprobar si like existe
        $isset_like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->count();
        
        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //guardar en DB
            $like->save();
            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'Ya le diste like a esta publicación'
            ]);
        }


    }

    public function dislike($image_id){

        //recoger datos del usuaruio e imagen
        $user = Auth::user();

        //Comprobar si like existe
        $like = Like::where('user_id', $user->id)
                            ->where('image_id', $image_id)
                            ->first();
        
        if($like){

            //Eliminar like
            $like->delete();
            
            return response()->json([
                'like' => $like,
                'message' => 'Has quitado tu Like'
            ]);
        }else{
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }

    }

    
}
