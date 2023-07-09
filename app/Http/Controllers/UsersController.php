<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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


}
