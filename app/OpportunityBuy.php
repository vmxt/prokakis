<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class OpportunityBuy extends Model
{
     
     protected $table = 'opp_buy';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'opp_title', 'what_sell_offer', 'audience_target', 'intro_describe_business', 'why_partner_goal', 'timeframe_goal', 'approx_large', 'ideal_partner_base',
        'ideal_partner_business', 'relevant_describing_partner', 'created_at', 'updated_at', 'added_by', 'edited_by', 'status', 'view_type', 'industry', 'avatar_status'
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
