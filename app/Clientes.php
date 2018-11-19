<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

    public $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'id',  'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
