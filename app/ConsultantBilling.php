<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ConsultantBilling extends Model
{
     
     protected $table = 'consultant_billing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'account_name', 'account_email', 'card_holder_name', 'card_number', 'security_code', 'card_expiry_date',
        'created_at', 'updated_at', 'created_by', 'updated_by' 
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
