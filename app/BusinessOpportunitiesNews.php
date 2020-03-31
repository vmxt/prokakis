<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BusinessOpportunitiesNews extends Model
{
     
     protected $table = 'opportunities_business_news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'content_business', 'business_title', 'created_at', 'updated_at', 'status' , 'feature_image'
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
