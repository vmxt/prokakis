<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SAConfiguration extends Model
{
     
     protected $table = 'sa_configuration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_controller', 'action', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
   

}
