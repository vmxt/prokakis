<?php

namespace App;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class PremiumOpportunityPurchased extends Model
{
     
     protected $table = 'premium_opportunity_purchased';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'opp_id', 'opp_type', 'num_token', 'token_startdate', 'token_enddate', 'remarks', 'status',
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

    public static function topUp($companyID, $opp_id, $opp_type){

        $date_now = date('Y-m-d');

        $month_start = $date_now;
		$date = date_create($month_start);
		date_add($date, date_interval_create_from_date_string("6 months"));
        $month_end = date_format($date, "Y-m-d");
                        
        PremiumOpportunityPurchased::create([
            'company_id' => $companyID, 
            'opp_id' => $opp_id, 
            'opp_type' => $opp_type, 
            'num_token' => 1, 
            'token_startdate' => $month_start, 
            'token_enddate' =>  $month_end,
            'created_at'=>date('Y-m-d'),
            'status' => 1, 
        ]);
    }

    public static function checkIfPremium($companyID, $opp_id, $opp_type){

      $pr =  PremiumOpportunityPurchased::where('company_id', $companyID)
        ->where('opp_id', $opp_id)
        ->where('opp_type', $opp_type)
        ->first();

        if($pr != null){
            return true;
        } else
        {
            return false;    
        }

    }
   
}
