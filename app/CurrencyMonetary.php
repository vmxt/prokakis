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
        
        $ccode = "";
        
        $final_amount = 0;
        
        $newamt = str_replace(",","",$amount);
        
        if(isset($acc->currency_id)){
            $curr_to = CurrencyMonetary::where('id',$acc->currency_id)->first();
            
            
            
            if( $curr_to->c_code != "USD" ){
                $sgd_curr = CurrencyMonetary::where('id',22)->first();
                $per_sgd = $sgd_curr->c_rate / 100;
                $new_amount = (double)$per_sgd * (double)$newamt;
                
                if($curr_to->c_code == "SGD"){
                    
                    $final_amount = $new_amount;
                    
                }
                else{
                    if(strpos($curr_to->c_name,'100')){
                        $per_1 = (double)$curr_to->c_rate / 100;
                        
                        $dev = (double)$new_amount / (double)$curr_to->c_rate;
                        $final_amount = $dev * 100;
                        
                        $rem = (double)$new_amount % (double)$curr_to->c_rate;
                        if($rem > 0){
                            $final_amount += ($per_1 * $rem);
                        }
                    }
                    else{
                        $final_amount = (double)$newamt  * (double)$curr_to->c_rate;
                    }
                }
            }
            else{
                $final_amount = (double)$newamt;
            }
            $ccode = $curr_to->c_code;
        }

        /*if(strpos($curr_from['c_name'],'100')){
            $res = $curr_from['c_rate'] * .01;
        }else{
            $res = $curr_from['c_rate'];
        }
        if($res){
            $out = $rate / $res;
        }else{
            $out = $rate ;
        }*/
        
        //$tt= 100;
        //return number_format($out, 2 , '.', ',')." ".$ccode;
        //return number_format($final,2);
        //return $rate1 = $rate / 100;
        /*$rem = $rate % 100;
        
        $new = ($rate1 * 137.49);
        $new2 = 100 / $rem;
        
        $final = $new + $new2;*/
        
        //$tt= 100;
        return number_format((float)$final_amount, 2, '.', ',')." ".$ccode;
        //return $curr_from['c_rate'];
    }
}
