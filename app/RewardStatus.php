<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class RewardStatus extends Model
{

     protected $table = 'reward_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'status', 'amount', 'created_at', 'updated_at' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id' 
    ];


}
