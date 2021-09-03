<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OpportunityBuildingCapability extends Model
{
     
     protected $table = 'opp_building_capability';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'opp_title', 'business_goal', 'audience_target', 'intro_describe_business', 'why_partner_goal', 'timeframe_goal', 'approx_large', 'ideal_partner_base',
        'ideal_partner_business', 'relevant_describing_partner', 'created_at', 'updated_at', 'added_by', 'edited_by', 'status', 'view_type' , 'industry', 'avatar_status', 'is_anywhere', 'est_profit', 'est_revenue', 'oppo_description',  'inventory_value' , 'currency'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];
   
    public static function getListBuildOpportunity(){
        return DB::table('opp_building_capability as opp')
                    ->select('opp.opp_title as opp_title', 
                             DB::raw("'build' as opp_type"),
                            'com.company_email AS company_email', 
                            'users.lastname AS last_name', 
                            'users.firstname AS first_name', 
                            'opp.id as opp_id', 
                            'users.email AS user_email')
                    ->join('company_profiles as com', 'opp.company_id', '=', 'com.id')
                     ->join('users as users', 'users.id', '=', 'com.user_id')->get();
    }

}
