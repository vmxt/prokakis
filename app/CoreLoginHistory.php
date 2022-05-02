<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CoreLoginHistory extends Model
{
     
     protected $table = 'core_login_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_email', 'ip_address', 'event', 'created_at', 'updated_at' , 'user_agent' , 'url', 'user_id', 'user_email'
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