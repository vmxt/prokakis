<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AccessToken;

class AccessTokenUser extends Model
{
     
     protected $table = 'access_token_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'secret_key', 'public_key', 'life_span', 'status', 'created_at', 'updated_at' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];


    //return 0 record not found
    //return false token does not match
    //return token if token matches
    public static function validateTransactionUrl($url)
    {
        $res = explode("|", $url);
        $asin = '';
        $public_key = '';
        $gen_code = '';

        if(isset($res[2])){
        $asin = base64_decode($res[2]); //salted_date;
        } else {
            die('invalid url');
        }  
        if(isset($res[0])){
        $public_key = base64_decode($res[0]); //public key
        }else {
            die('invalid url');
        }  
        if(isset($res[1])){
        $gen_code = base64_decode($res[1]); //token key
        }else {
            die('invalid url');
        }  

        $accToken = AccessToken::where('token', $gen_code)->where('public_key', $public_key)->first();

        if($accToken != null){

            if(AccessToken::checkExpiredToken($accToken->end_date) == 1){ //active

                $resp = array('result'=>'success','token'=>$accToken->token, 'message'=>'active');
                return $resp;
                exit;

            } else {


                $atu = AccessTokenUser::where('public_key', $public_key)->first();
                if($atu != null){

                    $sig = hash_hmac('haval256,5', $public_key,  $atu->secret_key.$asin);
                    $sDate = date('Y-m-d H:i:s');
                    //$dateResult = '';

                    //if($atu->life_span == '1hr'){
                    $dateResult = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($sDate)));
                    
                    //}else if($atu->life_span == '1day'){
                    //  $dateResult = date('Y-m-d H:i:s',strtotime('+1 day',strtotime($sDate)));
                    //}

                    //$date = new \DateTime($sDate);
                    //$date->add(new \DateInterval('PT1H30S'));  //P1D
                    //$dateResult1day = $date->format('Y-m-d H:i:s');
                
                    if($sig == $gen_code)
                    {
                        AccessToken::create([
                        'token'      => $sig, 
                        'public_key' => $public_key, 
                        'start_date' => $sDate, 
                        'end_date'   => $dateResult, 
                        ]);
                        
                        $resp = array('result'=>'success','token'=>$sig, 'message'=>'Token is newly created');
                        return $resp;
                        exit;    
                    } else{
                        
                        $resp = array('result'=>'invalid token');
                        return $resp;
                        exit;
                    }


                } else {

                    $resp = array('result'=>'invalid public key');
                    return $resp;
                    exit;
                }




            }

        } else {

                $atu = AccessTokenUser::where('public_key', $public_key)->first();
                if($atu != null){

                    $sig = hash_hmac('haval256,5', $public_key,  $atu->secret_key.$asin);
                    $sDate = date('Y-m-d H:i:s');
                    
                    //if($atu->life_span == '1hr'){
                    $dateResult = date('Y-m-d H:i:s',strtotime('+1 hour',strtotime($sDate)));
                    
                    //}else if($atu->life_span == '1day'){
                    //    $dateResult = date('Y-m-d H:i:s',strtotime('+1 day',strtotime($sDate)));
                    //}

                    //$date = new \DateTime($sDate);
                    //$date->add(new \DateInterval('PT1H'));  //P1D
                    //$dateResult1day = $date->format('Y-m-d H:i:s');
                
                    if($sig == $gen_code)
                    {
                        AccessToken::create([
                        'token'      => $sig, 
                        'public_key' => $public_key, 
                        'start_date' => $sDate, 
                        'end_date'   => $dateResult, 
                        ]);
                        
                        $resp = array('result'=>'success','token components'=>$sig, 'message'=>'Token is newly created');
                        return $resp;
            
                    } else{
                        
                        $resp = array('result'=>'invalid token');
                        return $resp;
                    
                    }


                } else {

                    $resp = array('result'=>'invalid public key');
                    return $resp;
                    
                }
        }
       
        
    }

}