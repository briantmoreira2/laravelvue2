<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{

    public $table = 'pedidos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion' , 'id_cliente'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
