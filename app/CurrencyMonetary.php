<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\CurrencyAccounts;
use App\CurrencyMonetary;
use Auth;
class CurrencyMonetary extends Model
{
     
     protected $table = 'currency_monetary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'c_code', 'c_name', 'c_text', 'c_rate', 'end_of_day'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
    

    public static function currencyConvertion($amount, $currencyNow=3){

        $acc = CurrencyAccounts::where('user_id',Auth::id())->first();
        $curr_from = CurrencyMonetary::where('id',$currencyNow)->first();
        $rate = (double)$amount;
        $ccode = "";
        if(isset($acc->currency_id)){
            $curr_to = CurrencyMonetary::where('id',$acc->currency_id)->first();
            $rate = (double)$amount * (double)$curr_to->c_rate;
            $ccode = $curr_to->c_cod;
        }

        if(strpos($curr_from['c_name'],'100')){
            $res = $curr_from['c_rate'] * .01;
        }else{
            $res = $curr_from['c_rate'];
        }
        if($res){
            $out = $rate / $res;
        }else{
            $out = $rate ;
        }
        return number_format((float)$out, 2, '.', ',')." ".$ccode;
    }
}
