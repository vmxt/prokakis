<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AccessToken extends Model
{
     
     protected $table = 'access_token';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'public_key', 'start_date', 'end_date', 'created_at', 'updated_at' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];

    public static function checkExpiredToken($dateEnd)
    {
        $today = date('Y-m-d H:i:s');
        $cDate = strtotime($today);
        $eDate = strtotime($dateEnd);
        if($cDate > $eDate){
            //echo 'expired';
            return 0; //expired
        } else {
            //echo 'active';
            return 1; //active
        }

    }

}