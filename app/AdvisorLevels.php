<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AdvisorLevels extends Model
{
     
     protected $table = 'advisors_levels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'company_id', 'user_id', 'advisor_level', 'earned_points', 'earned_amount', 'status', 'created_at', 'updated_at',
        'approver1', 'approver2', 'user_referral_ids', 'user_credit_ids', 'referral_pur_ids', 'referral_rep_ids', 'updated_by', 'ip_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];
   

    public static function getAdvisorStatus($level=1, $status=0){
      $usr =  User::find(Auth::id());
      if($usr != null){
          $ad =  AdvisorLevels::where('user_id', $usr->id)
          ->where('advisor_level',$level)
          ->where('status',$status)
          ->first();
          return $ad;
      }
    }

    public static function getAdvisorCurrentLevel($level){
      $usr =  User::find(Auth::id());
      if($usr != null){
          $ad =  AdvisorLevels::where('user_id', $usr->id)
          ->where('advisor_level',$level)
          ->first();
          return $ad;
      }
    }

    public static function getAdvisorLevelStatus($status){
      $usr =  User::find(Auth::id());
      if($usr != null){
          $ad =  AdvisorLevels::where('user_id', $usr->id)
          ->where('status',$status)
          ->first();
          return $ad;
      }
    }

}
