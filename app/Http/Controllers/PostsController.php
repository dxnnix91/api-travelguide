<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Posts;

class PostsController extends Controller
{
    public function posts(){
        $posts = Posts::All();
        return response()->json($posts);
    }

    public function create(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Validar datos recibidos
        $validate = \Validator::make($params_array, [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
        ]);

        if ($validate->fails()) {
            $data = array(
                'status'    => 'Error',
                'code'      => '400',
                'message'   => 'No se a podido crear en post',
                'errors'    => $validate->errors(),
            );
        } else {
            $post = new Posts();
            $post->user_id = $params_array['user_id'];
            $post->title = $params_array['title'];
            $post->content = $params_array['content'];
            $post->calification = $params_array['calification'];
            //$post->image = $params_array['image'];
            //$post->ubication = $params_array['ubication'];

            //Guardar el post
            $post->save();

            $data = array(
                'status'    => 'succes',
                'code'      => '200',
                'message'   => 'Post creado correctamente',
                'user'      => $post
            );
        }

        return response()->json($data, $data['code']);
        $params_array = array_map('trim', $params_array);//Limpiar parametro para validacion
    }

    public function update(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
    
        // Validar datos recibidos
        $validate = \Validator::make($params_array, [
            'id' => 'required'
        ]);
   
        if ($validate->fails()) {
            $data = array(
                'status' => 'Error',
                'code' => '400',
                'message' => 'El usuario no se ha podido actualizar',
                'errors' => $validate->errors(),
            );
        } else {
            $post = Posts::where('id', $params_array['id'])
            ->where('user_id', $params_array['user_id'])
            ->first();
    
            if (!$post) {
                $data = array(
                    'status'    => 'Error',
                    'code'      => '404',
                    'message'   => 'Post no encontrado',
                    'errors'    => null,
                );
            } else {
                $post = new Posts();
                    
                    $post->title = $params_array['title'];
                    $post->content = $params_array['content'];
                    $post->calification = $params_array['calification'];
                    //$post->image = $params_array['image'];
                    //$post->ubication = $params_array['ubication'];

                    //Actualzar el post
                    $post->save();

                $data = array(
                    'status' => 'success',
                    'code' => '200',
                    'message' => 'Post modificado correctamente',
                    'post' => $post
                );
            }
        }
    
        return response()->json($data, $data['code']);
    }

    public function delete(Request $request){
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        $post = Posts::where('id', $params_array['id'])
            ->where('user_id', $params_array['user_id'])
            ->first();

        if(!empty($post)){
            //Borrar el post
            $post->delete();
            $data = array(
                'status'    => 'Ssccess',
                'code'      => '200',
                'message'   => 'Post eliminado correctamente',
            );
        }else{
            $data = array(
                'status'    => 'error',
                'code'      => '400',
                'message'   => 'No se a podido eliminar el post',
            );
        }

        return response()->json($data, $data['code']);

    }

}
