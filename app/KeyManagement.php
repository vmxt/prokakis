<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class KeyManagement extends Model
{
     
     protected $table = 'key_management';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'idn_passport', 'nationality', 'gender', 'date_of_birth', 'shareholder', 'is_directorship', 'position', 
        'created_at', 'updated_at', 'status', 'added_by', 'updated_by'
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
