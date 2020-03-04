<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyReport extends Model
{
     
     protected $table = 'processed_report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'approval_id', 'requester_company_id', 'source_company_id', 'report_status', 'request_frequency_id',
        'num_tokens_credited', 'month_subscription_start', 'month_subscription_end', 'frequency_value', 'report_link',
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
