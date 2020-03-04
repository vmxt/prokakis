<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CompanySocialAccounts extends Model
{
     
     protected $table = 'company_social_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'countries', 'language_spoken', 'company_homepage', 'profile_link', 'linkedin', 'facebook', 'twitter', 'google', 'otherlink',
        'created_at', 'updated_at', 'added_by', 'edited_by' 
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
