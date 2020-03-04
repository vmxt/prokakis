<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class InvestorAlert extends Model
{
     
     protected $table = 'alertlist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'address_s',                   
        'date_dt',                   
        'unregulatedpersons_t',                   
        'website_s',                   
        'modifieddate_dt',                   
        'notes_s',                   
        'email_s',                   
        'phonenumber_s',                    
        'relatedunregulatedpersons_s', 
        'relatedunregulatedpersonsid_s',                   
        'formername_t',                     
        'alternativename_t',
        'score',  
        'created_at', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id_',  
    ];

 
   
}
