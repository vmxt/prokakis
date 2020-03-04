<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buytoken extends Model
{
     
     protected $table = 'buy_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'num_tokens', 'amount', 'created_at', 'updated_at', 'status', 'paypal_id', 'paypal_token',
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
