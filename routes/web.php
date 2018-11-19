<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Auth::routes();

Route::get('', 'HomeController@index')->name('home');

Route::group(['middleware'=>'role:administrador'], function () {


  Route::get('users', function () {
      return view('layouts.app');
  });

  Route::get('usuarios','usuarioscontroller@usuarios');

  Route::post('usuarios','usuarioscontroller@store_usuarios');

  Route::post('edit_usuarios/{id}','usuarioscontroller@edit_usuarios');

  Route::post('delete_usuarios/{id}','usuarioscontroller@delete_usuarios');


  Route::get('customers', function () {
      return view('layouts.app');
  });



  Route::post('clientes','clientescontroller@store_clientes');

  Route::post('edit_clientes/{id}','clientescontroller@edit_clientes');

  Route::post('delete_clientes/{id}','clientescontroller@delete_clientes');

});

  Route::get('clientes','clientescontroller@clientes');

Route::group(['middleware'=>'role:usuario'], function () {


    Route::get('orders', function () {
        return view('layouts.app');
    });

    Route::get('pedidos','pedidoscontroller@pedidos');

    Route::post('pedidos','pedidoscontroller@store_pedidos');

    Route::post('edit_pedidos/{id}','pedidoscontroller@edit_pedidos');

    Route::post('delete_pedidos/{id}','pedidoscontroller@delete_pedidos');



});
