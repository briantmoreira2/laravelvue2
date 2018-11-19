<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedidos;

class pedidoscontroller extends Controller
{
    protected function pedidos(){

      return Pedidos::all();
    }

    protected function edit_pedidos(Request $request, $id){

      $_POST = $request->all();

      $pedidos = Pedidos::find($id);
      $pedidos->fill($_POST);
      $pedidos->save();

      return Pedidos::all();

    }

    protected function store_pedidos(Request $request){

      $_POST = $request->all();

      $pedidos = new Pedidos;
      $pedidos->fill($_POST);
      $pedidos->save();

      return Pedidos::all();


    }

    protected function delete_pedidos($id){

      $pedidos = Pedidos::find($id);
      $pedidos->delete();

      return Pedidos::all();

    }
}
