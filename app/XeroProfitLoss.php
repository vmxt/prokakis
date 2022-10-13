<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class XeroProfitLoss extends Model
{

     protected $table = 'xero_profit_and_loss';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'json_content', 'org_name', 'org_id', 'title', 'description', 'from_date', 'to_date', 'period', 'timeframe', 'created_at', 'updated_at', 'status', 'editor_content'
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
