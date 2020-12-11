<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOwningRemoval extends Model
{
     
     protected $table = 'company_owning_or_removal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester_user_id', 'requester_company_id', 'subject_company_id', 
        'request_type', 'request_stage', 'status', 'passportFile', 'businessFile',
        'requester_name', 'requester_contact', 'requester_email',
        'created_at', 'updated_at'
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
