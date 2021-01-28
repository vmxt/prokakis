<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Subscribers extends Model
{

     protected $table = 'subscribers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'payer_email', 'start_date', 'end_date', 'subs_type', 'profileId', 'created_at', 'updated_at', 'status' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id' 
    ];

    public static function getSubscriberStatus($companyId)
    {
       $c_subs = Subscribers::where('company_id', $companyId)->where('status', 1)->count();
       if($c_subs > 0){
        return true;
       } else {
        return false;   
       }

    }



}
