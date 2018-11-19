<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role' , 'id_cliente'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
