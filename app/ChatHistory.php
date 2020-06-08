<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ChatHistory extends Model
{
     
     protected $table = 'chat_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender', 'receiver', 'text', 'opp_type', 'action'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id', 'created_at', 'updated_at',
    ];
   
    public static function getChatHistoryPerCompany($company_id){

        return 
            DB::table("chat_history as ch")
            ->select( 'ch.sender', 'ch.receiver', 'ch.text', 'ch.created_at', 'ch.opp_type', 'opp.opp_title', 'opp.company_id' )
            ->join('opp_building_capability as opp', 'ch.receiver', "=", 'opp.id')
            ->where('ch.opp_type', '=', 'build')
            ->where('opp.company_id','=',$company_id);
    }

}
