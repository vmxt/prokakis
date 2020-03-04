<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Unsubscribe extends Model
{

     protected $table = 'unsubscriber';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'user_id', 'notify_type', 'token', 'created_at', 'updated_at' 
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
