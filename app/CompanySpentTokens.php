<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CompanySpentTokens extends Model
{
     
     protected $table = 'company_spent_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'num_tokens', 'request_id', 'created_at', 'updated_at', 'added_by' 
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
