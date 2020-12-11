<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CompanySearchVideoChat extends Model
{
     
     protected $table = 'company_search_videochat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_id', 'provider_id', 'channel', 'status', 
        'created_at', 'updated_at',  
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
