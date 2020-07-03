<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ChatHistoryHead extends Model
{
     
     protected $table = 'chat_history_head';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender', 'receiver', 'opp_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at',
    ];
   
    public static function checkExistingData($sender, $receiver, $opp_type){

        return ChatHistoryHead::
                where('sender',$sender)
                ->where('receiver',$receiver)
                ->where('opp_type',$opp_type)
                ->where('is_deleted', 0)
                ->first();

    }

}
