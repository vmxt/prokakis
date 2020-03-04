<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

     protected $table = 'apps_currency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country', 'currency', 'code', 'symbol',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id' 
    ];
}
