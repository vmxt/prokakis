<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CurrencyAccounts extends Model
{
     
     protected $table = 'currency_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'currency_id', 'updated_at', 'created_at'
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
