<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyAccounts extends Model
{
     
     protected $table = 'currency_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'currency_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pid', 
    ];
    
    public function getCurrency(){
        return $this->hasOne(CurrencyMonetary::class,'id', 'currency_id');
    }

}
