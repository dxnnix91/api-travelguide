<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function user(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);//Objeto

        $email = $params->email;

        $user = User::Where([
            'email'     => $email,
        ])->first();

        if($user){
            $data = array(
                'code'      => '200',    
                'user'  => $user
            );
        }else{
            $data = array(
                'status'    => 'Error',
                'code'      => '400',
                'message'   => 'No existe el usuario',
            );
        }
    
        return response()->json($data, $data['code']);
    }

    public function register(Request $request)
    {
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Validar datos recibidos
        $validate = \Validator::make($params_array, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $data = array(
                'status'    => 'Error',
                'code'      => '400',
                'message'   => 'El usuario no se a podido crear',
                'errors'    => $validate->errors(),
            );
        } else {
            $user = new User();
            $user->name = $params_array['name'];
            $user->surname = $params_array['surname'];
            $user->age = $params_array['age'];
            $user->email = $params_array['email'];
            $user->password = $params_array['password'];
            $user->description = $params_array['description'];
            $user->image = $params_array['image'];

            //Guardar el usuario
            $user->save();

            $data = array(
                'status'    => 'succes',
                'code'      => '200',
                'message'   => 'Usuario creado correctamente',
                'user'      => $user
            );
        }

        return response()->json($data, $data['code']);
        $params_array = array_map('trim', $params_array);//Limpiar parametro para validacion
    }

    public function login(Request $request){
        $json = $request->input('json', null);
        $params = json_decode($json);//Objeto

        $email = $params->email;
        $password = $params->password;

        $user = User::Where([
            'email'     => $email,
            'password'  => $password
        ])->first();

        if($user){
            $data = array(
                'status'    => 'succes',
                'code'      => '200',
                'message'   => 'Usuario logueado correctamente',
                'user'      => $user
            );
        }else{
            $data = array(
                'status'    => 'Error',
                'code'      => '400',
                'message'   => 'Usuario o contraseña incorrecto',
            );
        }
    
        return response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
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
            $user = User::find($params_array['id']);
    
            if (!$user) {
                $data = array(
                    'status' => 'Error',
                    'code' => '404',
                    'message' => 'Usuario no encontrado',
                    'errors' => null,
                );
            } else {
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->age = $params_array['age'];
                $user->description = $params_array['description'];
                $user->image = $params_array['image'];
    
                // Ctualizar usuario el usuario
                $user->save();
    
                $data = array(
                    'status' => 'success',
                    'code' => '200',
                    'message' => 'Usuario modificado correctamente',
                    'user' => $user
                );
            }
        }
    
        return response()->json($data, $data['code']);
    }

    public function delete(Request $request){
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        $user = User::find($params_array['id']);

        if(!empty($user)){
            //Borrar el usuario
            $user->delete();
            $data = array(
                'status'    => 'Ssccess',
                'code'      => '200',
                'message'   => 'Usuario eliminado correctamente',
            );
        }else{
            $data = array(
                'status'    => 'error',
                'code'      => '404',
                'message'   => 'No se ha podido eliminar el usuario, no existe el usuario',
            );
        }

        return response()->json($data, $data['code']);

    }

}
