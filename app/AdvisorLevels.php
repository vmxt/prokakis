<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


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
        'approver1', 'approver2', 'user_referral_ids', 'user_credit_ids', 'referral_pur_ids', 'referral_rep_ids',
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
