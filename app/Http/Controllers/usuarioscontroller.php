<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class usuarioscontroller extends Controller
{
    protected function usuarios(){

      return User::all();
    }

    protected function edit_usuarios(Request $request, $id){

      $_POST = $request->all();

      $usuarios = User::find($id);
      $usuarios->fill($_POST);
      $usuarios->contrasena = $_POST['password'];
      $usuarios->password = bcrypt($_POST['password']);
      $usuarios->save();

      return User::all();

    }

    protected function store_usuarios(Request $request){

      $_POST = $request->all();

      $usuarios = new User;
      $usuarios->fill($_POST);
      $usuarios->contrasena = $_POST['password'];
      $usuarios->password = bcrypt($_POST['password']);
      $usuarios->save();

      return User::all();


    }

    protected function delete_usuarios($id){

      $usuarios = User::find($id);
      $usuarios->delete();

      return User::all();

    }
}
