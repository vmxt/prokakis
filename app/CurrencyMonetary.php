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
    
    
    public static function currencyConvertionBasedID($amount, $original_currency, $currencyNow){

        $ccode = "";
        
        $final_amount = 0;
        
        $newamt = str_replace(",","",$amount);
        
        $newamt = CurrencyMonetary::currencyToUS($newamt,$original_currency);
        
            $curr_to = CurrencyMonetary::where('id',$currencyNow)->first();
            
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
                        
                        if((double)$new_amount >= 1 && (double)$curr_to->c_rate >= 1){
                            $rem = (double)$new_amount % (double)$curr_to->c_rate;
                            if($rem > 0){
                                $final_amount += ($per_1 * $rem);
                            }
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
        
        
        return number_format((float)$final_amount, 2, '.', ',');
    }
    
    public static function currencyToUS($amount, $currency){
        
        if(!isset($currency) || $currency == 0 || $currency == ""){
            $currency = 3;
        }
        
        $curr_from = CurrencyMonetary::where('id',$currency)->first();
        $newamt = $amount;
        $final_amount = 0;
        
        $new_sgd_amount = 0;
        
        if( $curr_from->c_code != "USD" ){
            
            if($curr_from->c_code != "SGD"){
                if(strpos($curr_from->c_name,'100')){
                    $newamt = (double)$newamt / 100;
                    $per_1 = (double)$curr_from->c_rate / 100;
                    
                    $final_amount = (double)$newamt * $curr_from->c_rate;
                            
                    if((double)$newamt >= 1 && (double)$curr_from->c_rate >= 1){
                        $rem = (double)$newamt % 100;
                        if($rem > 0){
                            $final_amount += ($per_1 * $rem);
                        }
                    }
                }
                else{
                    $final_amount = (double)$newamt  * (double)$curr_from->c_rate;
                }
            }
            else{
                $final_amount = $newamt;
            }
            
            $sgd_curr = CurrencyMonetary::where('id',22)->first();
            $per_sgd = 100 / $sgd_curr->c_rate;
            
            $final_amount = (double)$final_amount * (double)$per_sgd;
            
        }
        else{
            $final_amount = (double)$newamt;
        }
        
        return $final_amount;
    }

    public static function currencyConvertion($amount, $currencyNow){
        
        $acc = CurrencyAccounts::where('user_id',Auth::id())->first();
        
        $ccode = "";
        
        $final_amount = 0;
        
        $newamt = str_replace(",","",$amount);
        
        $newamt = CurrencyMonetary::currencyToUS($newamt,$currencyNow);
        
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
                        
                        if((double)$new_amount >= 1 && (double)$curr_to->c_rate >= 1){
                            $rem = (double)$new_amount % (double)$curr_to->c_rate;
                            if($rem > 0){
                                $final_amount += ($per_1 * $rem);
                            }
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
        
        if($acc->currency_id == $currencyNow){
            return number_format((float)str_replace(",","",$amount), 2, '.', ',')." ".$ccode;
        }
        else{
            return number_format((float)$final_amount, 2, '.', ',')." ".$ccode;
        }
    }
}
