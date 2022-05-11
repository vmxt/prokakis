<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class PaypalIpn extends Model
{
     
     protected $table = 'paypal_ipn';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_name', 'payment_status', 'mc_gross', 'mc_currency', 'txn_id', 'payer_email', 'txt_type', 'created_at', 'updated_at', 'logs'
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