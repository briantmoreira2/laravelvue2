<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Clientes;

class clientescontroller extends Controller
{
    protected function clientes(){

      return Clientes::all();
    }

    protected function edit_clientes(Request $request, $id){

      $_POST = $request->all();

      $clientes = Clientes::find($id);
      $clientes->fill($_POST);
      $clientes->save();

      return Clientes::all();

    }

    protected function store_clientes(Request $request){

      $_POST = $request->all();

      $clientes = new Clientes;
      $clientes->fill($_POST);
      $clientes->save();

      return Clientes::all();


    }

    protected function delete_clientes($id){

      $clientes = Clientes::find($id);
      $clientes->delete();

      return Clientes::all();

    }
}
