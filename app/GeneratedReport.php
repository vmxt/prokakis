<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class GeneratedReport extends Model
{
     
     protected $table = 'generated_report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_company_id', 'provider_company_id', 'request_id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
    
   
    public static function reportSave($requester, $provider, $reqId)
    {
        GeneratedReport::create([ 
       'requester_company_id' => $requester, 
       'provider_company_id'  => $provider, 
       'request_id'           => $reqId, 
       'created_at'           => date('Y-m-d'),
        ]);
            
    }
}
