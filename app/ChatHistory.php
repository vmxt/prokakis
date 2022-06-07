<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Auth;
use App\CompanyProfile;

class ChatHistory extends Model
{
     
     protected $table = 'chat_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'text', 'action', 'head_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id', 'created_at', 'updated_at',
    ];
   
    public static function getChatHistoryBuildOpportunityUnseenTotal($company_id){

            return DB::table("chat_history as ch")
                        ->select('head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at', 'head.opp_type', 'opp.opp_title', 'opp.company_id' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_building_capability as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type',  'build')
                        ->where('head.is_deleted', 0)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->whereRaw(" if(head.sender = ".$company_id.", action = 2, action = 1) ")
                        ->where('ch.status',0)
                        ->count();    
    }

    public static function getChatHistoryBuildOpportunity($company_id){

            return DB::table("chat_history as ch")
                        ->select('head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at', 'head.opp_type', 'opp.opp_title', 'opp.company_id' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_building_capability as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type',  'build')
                        ->where('head.is_deleted', 0)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->groupBy('sender','receiver')
                        ->orderBy('created_at','desc')
                        ->get();     
    }

    public static function getChatHistorySellOpportunityUnseenTotal($company_id){

            return DB::table("chat_history as ch")
                        ->select( DB::raw('COUNT(ch.id) as count_refer') )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_sell_offer as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type', '=', 'sell')
                        ->where('head.is_deleted', 0)
                        //->where('opp.company_id','=',$company_id)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->whereRaw(" if(head.sender = ".$company_id.", action = 2, action = 1) ")
                        ->where('ch.status',0)
                        ->count(); 

    }

    public static function getChatHistorySellOpportunity($company_id){



            return DB::table("chat_history as ch")
                        ->select( 'head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at', 'head.opp_type', 'opp.opp_title', 'opp.company_id' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_sell_offer as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type', '=', 'sell')
                        ->where('head.is_deleted', 0)
                        //->where('opp.company_id','=',$company_id)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->groupBy('sender','receiver')
                        ->orderBy('created_at','desc')
                        ->get();
            
    }

    public static function getChatHistoryBuyOpportunityUnseenTotal($company_id){

           return DB::table("chat_history as ch")
                        ->select( 'head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at', 'head.opp_type', 'opp.opp_title', 'opp.company_id' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_buy as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type', '=', 'buy')
                        ->where('head.is_deleted', 0)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->whereRaw(" if(head.sender = ".$company_id.", action = 2, action = 1) ")
                        ->where('ch.status',0)
                        ->count(); 
            
    }

    public static function getChatHistoryBuyOpportunity($company_id){

           return DB::table("chat_history as ch")
                        ->select( 'head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at', 'head.opp_type', 'opp.opp_title', 'opp.company_id' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->join('opp_buy as opp', 'head.receiver', "=", 'opp.id')
                        ->where('head.opp_type', '=', 'buy')
                        ->where('head.is_deleted', 0)
                        ->where(function ($query) use ( $company_id) {
                            $query->where('opp.company_id', '=', $company_id);
                            $query->orWhere('head.sender', '=', $company_id);
                        })
                        ->groupBy('sender','receiver')
                        ->orderBy('created_at','desc')
                        ->get();
            
    }

    public static function getStatusCount($head_id){
        /*return   
            ChatHistory::where('head_id', $head_id)
                ->where('status', 0)
                ->count();*/
        $user_id = Auth::id();  
        $company_id = CompanyProfile::getCompanyId($user_id);
        
        return DB::table("chat_history as ch")
                        ->select( 'head.id as head_id', 'ch.status', 'head.sender', 'head.receiver', 'ch.text', 'ch.created_at' )
                        ->join('chat_history_head as head', 'head.id', "=", 'ch.head_id')
                        ->where('head_id', $head_id)
                       ->where('status', 0)
                       ->whereRaw(" if(head.sender = ".$company_id.", action = 2, action = 1) ")
                        ->count();
    }
            
    public static function getChatDetails($headId, $status){
        return ChatHistory::where('head_id', $headId)
                ->update(['status'=>1]);

    }

    public static function getChatPayStatus($oppId, $oppType, $comRequester, $comProvider)
    {
        $remarks = 'Inbox Me at Opportunity Page with OppId:'.$oppId.' and OppType:'.$oppType.' and Requester:'.$comRequester.' and Provider:'.$comProvider;
        $c = SpentTokens::where('remarks', $remarks)->count();

        if($c > 0){
          return true;
        } else {
         return false;   
        }
    }

}
